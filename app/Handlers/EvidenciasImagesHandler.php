<?php


namespace App\Handlers;


use App\Constants\FileConstants;
use App\Constants\StatusConstants;
use App\Helpers\ExcelFileHelper;
use App\Helpers\FileHelper;
use App\Helpers\ImageFileHelper;
use App\Models\EstablecimientosCatalog;
use App\Models\EstadosReplubicaCatalog;
use App\Models\Evidencia;
use App\Models\JefeDeSector;
use App\Models\Tiro;
use App\Repositories\EstablecimientosRepository;
use App\Repositories\EstadosRepublicaRepository;
use App\Repositories\EvidenciasRepository;
use App\Repositories\JefeDeSectorRepository;
use App\Repositories\TirosRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use function Psy\debug;


class EvidenciasImagesHandler
{

    /**
     * @var FileHelper
     */
    protected FileHelper $fileHelper;
    /**
     * @var EvidenciasRepository
     */
    protected EvidenciasRepository $evidenciaRepository;

    protected ImageFileHelper $imageHelper;

    protected string $pathToDeliveryImage = '';
    protected string $pathToEstablecimientoImage = '';

    protected string $resizedDeliveryImage = '';
    protected string $resizedEstablecimientoImage = '';

    protected string $urlDeliveryImage = '';
    protected string $urlEstablecimientoImage = '';


    /**
     * ExcelFileUploadHandler constructor.
     * @param FileHelper $fileHelper
     * @param ImageFileHelper $imageHelper
     * @param EvidenciasRepository $evidenciaRepository
     */
    public function __construct(FileHelper $fileHelper,
                                ImageFileHelper $imageHelper,
                                EvidenciasRepository $evidenciaRepository
    )
    {
        $this->fileHelper = $fileHelper;
        $this->imageHelper = $imageHelper;
        $this->evidenciaRepository = $evidenciaRepository;
    }

    public function processEvidenciasFilesForTiro(array $tiro)
    {
        $this->pathToDeliveryImage = $this->fileHelper->saveUploadDeliveryImage($tiro);
        $this->pathToEstablecimientoImage = $this->fileHelper->saveUploadEstablecimientoImage($tiro);

        $this->resizedDeliveryImage = $this->dealWithImageConvertion($this->pathToDeliveryImage, $tiro['id'], 'delivery');
        $this->resizedEstablecimientoImage = $this->dealWithImageConvertion($this->pathToEstablecimientoImage, $tiro['id'], 'establecimiento');

        $this->urlDeliveryImage = $this->generateImageUrl($tiro['id'], 'delivery');
        $this->urlEstablecimientoImage = $this->generateImageUrl($tiro['id'], 'establecimiento');

        $this->dealWithDeliveryEvidence($tiro);
        $this->dealWithEstablecimientoEvidence($tiro);

    }

    public function dealWithImageConvertion(string $pathToImageToConvert, string $tiro_id, string $type = 'delivery')
    {
        $resizedImagePath = $this->imageHelper->convertImageFile($pathToImageToConvert, $tiro_id, $type);

        Log::debug("Image Resize Path  $resizedImagePath");

        return $resizedImagePath;
    }

    public function generateImageUrl(string $tiro_id, string $typeOfEvidence = 'delivery')
    {
        $evidenceType = ($typeOfEvidence === 'delivery') ?
            FileConstants::EVIDENCE_DELIVERY_SAVED_PREFIX :
            FileConstants::EVIDENCE_ESTABLECIMIENTO_SAVED_PREFIX;


        $imageUrl = url(
            FileConstants::EVIDENCE_DIRECTORY .
            $evidenceType .
            $tiro_id .
            FileConstants::EVIDENCE_RESIZED_FILE_SUFFIX .
            FileConstants::EVIDENCE_RESIZED_EXTENSION
        );

        Log::debug("Image Resize URL $imageUrl");

        return $imageUrl;
    }

    public function dealWithDeliveryEvidence(array $tiroResource)
    {
        $foundDeliveryForTiro = $this->evidenciaRepository->getDeliveryEvidenciaForTiroId($tiroResource['id']);

        Log::debug("FOUND DELIVERY EVIDENCE " . print_r($foundDeliveryForTiro->toArray(), true));

        if (empty($foundDeliveryForTiro)) {

            $delivery = new Evidencia();

            $delivery->tiro_id = $tiroResource['id'];
            $delivery->fecha_evidencia = Carbon::now();
            $delivery->foto_url = $this->urlDeliveryImage;
            $delivery->tipo = 'delivery';
            $delivery->original_image_path = $this->pathToDeliveryImage;
            $delivery->comentarios = $tiroResource['comentarios'];
            $delivery->gps_location_lat = $tiroResource['latitude'];
            $delivery->gps_location_long = $tiroResource['longitude'];
            $delivery->status = StatusConstants::AWAITING_STATUS;

            $delivery->save();


        } else {

            $foundDeliveryForTiro->fecha_evidencia = Carbon::now();
            $foundDeliveryForTiro->foto_url = $this->urlDeliveryImage;
            $foundDeliveryForTiro->original_image_path = $this->pathToDeliveryImage;
            $foundDeliveryForTiro->comentarios = $tiroResource['comentarios'];
            $foundDeliveryForTiro->gps_location_lat = $tiroResource['latitude'];
            $foundDeliveryForTiro->gps_location_long = $tiroResource['longitude'];
            $foundDeliveryForTiro->status = StatusConstants::EVIDENCE_PROVIDED;

            $foundDeliveryForTiro->save();
        }
    }

    public function dealWithEstablecimientoEvidence(array $tiroResource)
    {

        $foundEstablecimientForTiro = $this->evidenciaRepository
            ->getEstablecimientoEvidenciaForTiroId($tiroResource['id']);

        if (empty($foundEstablecimientForTiro)) {

            $establecimiento = new Evidencia();

            $establecimiento->tiro_id = $tiroResource['id'];
            $establecimiento->fecha_evidencia = Carbon::now();
            $establecimiento->foto_url = $this->urlEstablecimientoImage;
            $establecimiento->tipo = 'establecimiento';
            $establecimiento->original_image_path = $this->pathToEstablecimientoImage;
            $establecimiento->comentarios = $tiroResource['comentarios'];
            $establecimiento->gps_location_lat = $tiroResource['latitude'];
            $establecimiento->gps_location_long = $tiroResource['longitude'];
            $establecimiento->status = StatusConstants::AWAITING_STATUS;

            $establecimiento->save();


        } else {

            $foundEstablecimientForTiro->fecha_evidencia = Carbon::now();
            $foundEstablecimientForTiro->foto_url = $this->urlEstablecimientoImage;
            $foundEstablecimientForTiro->original_image_path = $this->pathToEstablecimientoImage;
            $foundEstablecimientForTiro->comentarios = $tiroResource['comentarios'];
            $foundEstablecimientForTiro->gps_location_lat = $tiroResource['latitude'];
            $foundEstablecimientForTiro->gps_location_long = $tiroResource['longitude'];
            $foundEstablecimientForTiro->status = StatusConstants::EVIDENCE_PROVIDED;

            $foundEstablecimientForTiro->save();

        }

    }

}
