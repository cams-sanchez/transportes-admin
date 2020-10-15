<?php


namespace App\Handlers;


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
use App\Models\Tren;
use App\Repositories\EstablecimientosRepository;
use App\Repositories\EstadosRepublicaRepository;
use App\Repositories\EvidenciasRepository;
use App\Repositories\JefeDeSectorRepository;
use App\Repositories\TemporadaRepository;
use App\Repositories\TirosRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\Shared\Date;


class ExcelFileUploadHandler
{

    /** @var FileHelper */
    protected FileHelper $fileHelper;

    /** @var TirosRepository */
    protected TirosRepository $tiroRepository;

    /** @var JefeDeSectorRepository */
    protected JefeDeSectorRepository $jefeDeSector;

    /** @var EstablecimientosRepository */
    protected EstablecimientosRepository $establecimientoRepository;

    /** @var EstadosRepublicaRepository */
    protected EstadosRepublicaRepository $estadosRepublicaRepository;

    /** @var EvidenciasRepository $evidenciasRepository */
    protected EvidenciasRepository $evidenciasRepository;

    /** @var TemporadaRepository $temporadaRepository */
    protected TemporadaRepository $temporadaRepository;

    /** @var array $infoFromExcel */
    protected $infoFromExcel = [];

    /** @var string $excelFilePath */
    protected string $excelFilePath = '';

    /** @var string $s3ExceliFileUrl */
    protected string $s3ExceliFileUrl = '';

    /** @var string $zonaRepublica */
    protected string $zonaRepublica = '';

    /**
     * ExcelFileUploadHandler constructor.
     * @param FileHelper $fileHelper
     * @param ExcelFileHelper $excelFileHelper
     * @param TirosRepository $tiroRepository
     * @param JefeDeSectorRepository $jefeDeSector
     * @param EstablecimientosRepository $establecimientoRepository
     * @param EstadosRepublicaRepository $estadosRepublicaRepository
     * @param EvidenciasRepository $evidenciasRepository
     * @param TemporadaRepository $temporadaRepository
     */
    public function __construct(
        FileHelper $fileHelper,
        ExcelFileHelper $excelFileHelper,
        TirosRepository $tiroRepository,
        JefeDeSectorRepository $jefeDeSector,
        EstablecimientosRepository $establecimientoRepository,
        EstadosRepublicaRepository $estadosRepublicaRepository,
        EvidenciasRepository $evidenciasRepository,
        TemporadaRepository $temporadaRepository
    ) {
        $this->fileHelper = $fileHelper;
        $this->excelFileHelper = $excelFileHelper;
        $this->tiroRepository = $tiroRepository;
        $this->jefeDeSector = $jefeDeSector;
        $this->establecimientoRepository = $establecimientoRepository;
        $this->estadosRepublicaRepository = $estadosRepublicaRepository;
        $this->evidenciasRepository = $evidenciasRepository;
        $this->temporadaRepository = $temporadaRepository;
    }

    public function saveUploadedFile(array $excelFileResource)
    {
        return $this->fileHelper->uploadExcelFile($excelFileResource);
    }

    public function readExcelFile(string $pathToExcelFile)
    {
        return $this->excelFileHelper->readExcelFileInfo($pathToExcelFile);
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
        $this->zonaRepublica = $excelFileResource['zonaRepublica'];
        $this->excelFilePath = $this->saveUploadedFile($excelFileResource);
        $this->saveExcelFileToS3();
        $this->getS3Url();

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
        $this->tiro = $this->tiroRepository->getTiroByDeliveryNumber(
            [
                'deliveryNumber' => $newTiro['delivery']
            ]
        );


        if (empty($this->tiro)) {

            $jefeDeSector = $this->dealWithJefeDeSector($newTiro['jefeDeSector']);
            $establecimiento = $this->dealWithEstablecimientoInformation($newTiro['nombre']);

            $viaje = $this->dealWithTrenAndViajeCreation();
            $unidad = Unidad::get()->first();
            $carga = TiposDeCargaCatalog::get()->first();

            $this->tiro = new Tiro();

            $this->tiro->viaje_id = $viaje->id;
            $this->tiro->unidad_id = $unidad->id;
            $this->tiro->establecimiento_id = $establecimiento->id;
            $this->tiro->ciudad = $newTiro['ciudad'];
            $this->tiro->tipo_carga_id = $carga->id;
            $this->tiro->cantidad = 0;
            $this->tiro->delivery = $newTiro['delivery'];
            $this->tiro->jefe_de_sector_id = $jefeDeSector->id;
            $this->tiro->region = $newTiro['region'];
            $this->tiro->fecha_entrega_solicitada = Carbon::instance(Date::excelToDateTimeObject($newTiro['fechaEntregaSolcitidada']));
            $this->tiro->propuesta_361 = Carbon::instance(Date::excelToDateTimeObject($newTiro['propuesta361']));
            $this->tiro->status = StatusConstants::ACTIVE_STATUS;
            $this->tiro->notas = '';

            $this->tiro->save();
        }

        $evidencias = $this->evidenciasRepository->getEvidenciasForTiroId($this->tiro->id);

        if (empty($evidencias)) {
            $evidencias = [
                0 => $this->saveEvidencias('delivery'),
                1 => $this->saveEvidencias('establecimiento'),
            ];
        }

        $this->tiro->evidencias = $evidencias;
    }

    protected function saveEvidencias($evidenciaType = 'delivery')
    {
        $evidencia = new Evidencia();

        $evidencia->tiro_id = $this->tiro->id;
        $evidencia->fecha_evidencia = Carbon::now();
        $evidencia->foto_url = '';
        $evidencia->tipo = $evidenciaType;
        $evidencia->original_image_path = '';
        $evidencia->comentarios = '';
        $evidencia->gps_location_lat = 0.0;
        $evidencia->gps_location_long = 0.0;
        $evidencia->status = StatusConstants::AWAITING_STATUS;

        $evidencia->save();

        return $evidencia;
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

    public function dealWithTrenAndViajeCreation()
    {
        $temporada = $this->temporadaRepository->searchTemporadaByName();
        $tren = new Tren();
        $fecha = Carbon::now();

        $tren->temporada_id = $temporada->id;
        $tren->nombre = "Tren Zona {$this->zonaRepublica} {$fecha->format('m-d-Y')}";
        $tren->zona = $this->zonaRepublica;
        $tren->descripcion = '';
        $tren->fecha_comienzo = $fecha;
        $tren->fecha_fin = null;
        $tren->status = 'ACTIVO';
        $tren->save();


        $viaje = new Viaje();
        $estadoRep = EstadosReplubicaCatalog::where('estado', '=', 'Estado de México')->first();

        $viaje->tren_id = $tren->id;
        $viaje->estados_replubica_catalogs_id = $estadoRep->id;
        $viaje->nombre = "Viaje_{$this->zonaRepublica}_{$fecha->format('m-d-Y')}";
        $viaje->fecha_comienzo = $fecha;
        $viaje->fecha_carga = $fecha;
        $viaje->fecha_salida_carga = null;
        $viaje->status = 'ACTIVO';

        $viaje->save();

        return $viaje;
    }
}
