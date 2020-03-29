<?php


namespace App\Handlers;


use App\Constants\FileConstants;
use App\Constants\StatusConstants;
use App\Helpers\ExcelFileHelper;
use App\Helpers\FileHelper;
use App\Models\EstablecimientosCatalog;
use App\Models\EstadosReplubicaCatalog;
use App\Models\Evidencia;
use App\Models\JefeDeSector;
use App\Models\TiposDeCargaCatalog;
use App\Models\Tiro;
use App\Models\Unidad;
use App\Models\Viaje;
use App\Repositories\EstablecimientosRepository;
use App\Repositories\EstadosRepublicaRepository;
use App\Repositories\EvidenciasRepository;
use App\Repositories\JefeDeSectorRepository;
use App\Repositories\TirosRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\Shared\Date;


class ExcelFileUploadHandler
{

    /**
     * @var FileHelper
     */
    protected FileHelper $fileHelper;
    /**
     * @var TirosRepository
     */
    protected TirosRepository $tiroRepository;
    /**
     * @var JefeDeSectorRepository
     */
    protected JefeDeSectorRepository $jefeDeSector;
    /**
     * @var EstablecimientosRepository
     */
    protected EstablecimientosRepository $establecimientoRepository;

    /** @var EstadosRepublicaRepository */
    protected EstadosRepublicaRepository $estadosRepublicaRepository;

    /** @var EvidenciasRepository $evidenciasRepository */
    protected EvidenciasRepository $evidenciasRepository;

    /** @var array $infoFromExcel */
    protected $infoFromExcel = [];

    /** @var string $excelFilePath */
    protected string $excelFilePath = '';

    /** @var string $s3ExceliFileUrl */
    protected string $s3ExceliFileUrl = '';
    /**
     * ExcelFileUploadHandler constructor.
     * @param FileHelper $fileHelper
     * @param ExcelFileHelper $excelFileHelper
     * @param TirosRepository $tiroRepository
     * @param JefeDeSectorRepository $jefeDeSector
     * @param EstablecimientosRepository $establecimientoRepository
     * @param EstadosRepublicaRepository $estadosRepublicaRepository
     * @param EvidenciasRepository $evidenciasRepository
     */
    public function __construct(FileHelper $fileHelper,
                                ExcelFileHelper $excelFileHelper,
                                TirosRepository $tiroRepository,
                                JefeDeSectorRepository $jefeDeSector,
                                EstablecimientosRepository $establecimientoRepository,
                                EstadosRepublicaRepository $estadosRepublicaRepository,
                                EvidenciasRepository $evidenciasRepository
    )
    {
        $this->fileHelper = $fileHelper;
        $this->excelFileHelper = $excelFileHelper;
        $this->tiroRepository = $tiroRepository;
        $this->jefeDeSector = $jefeDeSector;
        $this->establecimientoRepository = $establecimientoRepository;
        $this->estadosRepublicaRepository = $estadosRepublicaRepository;
        $this->evidenciasRepository = $evidenciasRepository;
    }

    public function saveUploadedFile(array $excelFileResource)
    {
        return $this->fileHelper->uploadExcelFile($excelFileResource);
    }

    public function readExcelFile(string $pathToExcelFile)
    {
        return $this->excelFileHelper->readExcelFileInfoFromFile($pathToExcelFile);
    }

    public function saveExcelFileToS3()
    {
        $this->fileHelper->saveExcelFileToS3($this->excelFilePath);
    }

    public function getS3Url()
    {
        $this->s3ExceliFileUrl = Storage::disk('s3')->url($this->fileHelper->s3ExcelFilePath);

        Log::debug("URL FILE $this->s3ExceliFileUrl");
    }

    public function processUploadedExcelFile(array $excelFileResource)
    {
        $this->excelFilePath = $this->saveUploadedFile($excelFileResource);
        $this->saveExcelFileToS3();
        $this->getS3Url();

        Log::debug("S3 BOCKET PATH " . $this->fileHelper->s3ExcelFilePath);

        $this->infoFromExcel = $this->readExcelFile($this->excelFilePath);
        $this->readExcelInfoAndCreateTiros();
        $this->fileHelper->removeFileFromLocal($this->excelFilePath);
    }

    public function readExcelInfoAndCreateTiros()
    {
        foreach ($this->infoFromExcel as $newTiro) {

            $this->createNewTiro($newTiro);
        }
    }

    public function createNewTiro(array $newTiro)
    {
        Log::debug("TIRO A PROCESAR " . print_r($newTiro, true));

        $this->tiro = $this->tiroRepository->searchTiroBydelivery($newTiro[1]);


        if (empty($this->tiro)) {

            $jefeDeSector = $this->dealWithJefeDeSector($newTiro[3]);
            $establecimiento = $this->dealWithEstablecimientoInformation($newTiro[5]);

            $viaje = Viaje::get()->first();
            $unidad = Unidad::get()->first();
            $carga = TiposDeCargaCatalog::get()->first();

            $this->tiro = new Tiro();

            $this->tiro->viaje_id = $viaje->id;
            $this->tiro->unidad_id = $unidad->id;
            $this->tiro->establecimiento_id = $establecimiento->id;
            $this->tiro->ciudad = $newTiro[0];
            $this->tiro->tipo_carga_id = $carga->id;
            $this->tiro->cantidad = 0;
            $this->tiro->delivery = $newTiro[1];
            $this->tiro->epv = $newTiro[2];
            $this->tiro->jefe_de_sector_id = $jefeDeSector->id;
            $this->tiro->sdic = $newTiro[4];
            $this->tiro->doc = $newTiro[6];
            $this->tiro->region = $newTiro[1];
            $this->tiro->fecha_entrega_solicitada = Carbon::instance(Date::excelToDateTimeObject($newTiro[9]));
            $this->tiro->propuesta_361 = Carbon::instance(Date::excelToDateTimeObject($newTiro[10]));
            $this->tiro->notas = '';
            $this->tiro->status = StatusConstants::ACTIVE_STATUS;

            $this->tiro->save();
        }

        $evidencias = $this->evidenciasRepository->getEvidenciasForTiroId($this->tiro->id);

        if (empty($evidencias)) {

            $delivery = new Evidencia();

            $delivery->tiro_id = $this->tiro->id;
            $delivery->fecha_evidencia = Carbon::now();
            $delivery->foto_url = '';
            $delivery->tipo = 'delivery';
            $delivery->original_image_path = '';
            $delivery->comentarios = '';
            $delivery->gps_location_lat = 0.0;
            $delivery->gps_location_long = 0.0;
            $delivery->status = StatusConstants::AWAITING_STATUS;

            $delivery->save();

            $establecimiento = new Evidencia();

            $establecimiento->tiro_id = $this->tiro->id;
            $establecimiento->fecha_evidencia = Carbon::now();
            $establecimiento->foto_url = '';
            $establecimiento->tipo = 'establecimiento';
            $establecimiento->original_image_path = '';
            $establecimiento->comentarios = '';
            $establecimiento->gps_location_lat = 0.0;
            $establecimiento->gps_location_long = 0.0;
            $establecimiento->status = StatusConstants::AWAITING_STATUS;

            $establecimiento->save();

            $evidencias = [
                0 => $delivery,
                1 => $establecimiento,
            ];
        }

        $this->tiro->evidencias = $evidencias;
    }

    public function dealWithEstadoInformation(string $estadoToWorkWith)
    {
        $estado = $this->estadosRepublicaRepository->getEstadoByName($estadoToWorkWith);

        if (empty($estado)) {
            $estado = new EstadosReplubicaCatalog();
            $estado->region = '';
            $estado->estado = $estadoToWorkWith;
            $estado->save();
        }

        return $estado;
    }

    public function dealWithEstablecimientoInformation(string $establecimientoToWorkWith)
    {
        $establecimiento = $this->establecimientoRepository->getEstablecimientoByName($establecimientoToWorkWith);

        if (empty($establecimiento)) {

            $establecimiento = new EstablecimientosCatalog();

            $establecimiento->nombre = $establecimientoToWorkWith;
            $establecimiento->status = StatusConstants::ACTIVE_STATUS;
            $establecimiento->save();
        }

        return $establecimiento;
    }

    public function dealWithJefeDeSector(string $jefeDeSectorToWorkWith)
    {
        $jefeDeSector = $this->jefeDeSector->getjefeDeSectorByName($jefeDeSectorToWorkWith);

        if (empty($jefeDeSector)) {

            $jefeDeSector = new JefeDeSector();

            $jefeDeSector->nombre = $jefeDeSectorToWorkWith;
            $jefeDeSector->email = '';
            $jefeDeSector->contactos_telefonicos = '';
            $jefeDeSector->direccion = '';
            $jefeDeSector->status = StatusConstants::ACTIVE_STATUS;

            $jefeDeSector->save();
        }

        return $jefeDeSector;
    }
}
