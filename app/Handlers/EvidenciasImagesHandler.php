<?php


namespace App\Handlers;


use App\Constants\FileConstants;
use App\Constants\StatusConstants;
use App\Helpers\FileHelper;
use App\Helpers\ImageFileHelper;
use App\Models\Evidencia;
use App\Repositories\EvidenciasRepository;
use App\Repositories\TirosRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;


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

    protected TirosRepository $tirosRepository;

    protected string $pathToDeliveryImage = '';
    protected string $pathToEstablecimientoImage = '';

    protected string $resizedDeliveryImage = '';
    protected string $resizedEstablecimientoImage = '';

    protected string $urlDeliveryImage = '';
    protected string $urlEstablecimientoImage = '';

    protected string $s3DeliveryUrl = '';
    protected string $s3EstablecimientoUrl = '';

    protected string $s3ResizedDeliveryUrl = '';
    protected string $s3ResizedEstablecimientoUrl = '';


    /**
     * ExcelFileUploadHandler constructor.
     * @param FileHelper $fileHelper
     * @param ImageFileHelper $imageHelper
     * @param EvidenciasRepository $evidenciaRepository
     * @param TirosRepository $tirosRepository
     */
    public function __construct(FileHelper $fileHelper,
                                ImageFileHelper $imageHelper,
                                EvidenciasRepository $evidenciaRepository,
                                TirosRepository $tirosRepository
    )
    {
        $this->fileHelper = $fileHelper;
        $this->imageHelper = $imageHelper;
        $this->evidenciaRepository = $evidenciaRepository;
        $this->tirosRepository = $tirosRepository;
    }

    public function processEvidenciasFilesForTiro(array $tiro)
    {

        $tiroFound = $this->tirosRepository->getTiroById($tiro);

        if (empty($tiroFound)) {
            return false;
        }

        $this->pathToDeliveryImage = $this->fileHelper->saveUploadDeliveryImage($tiro);
        $this->pathToEstablecimientoImage = $this->fileHelper->saveUploadEstablecimientoImage($tiro);

        //$this->fileHelper->saveDeliveryImageToS3($this->pathToDeliveryImage, $tiro['id']);
        //$this->fileHelper->saveEstablecimientoImageToS3($this->pathToEstablecimientoImage, $tiro['id']);

        //$this->getS3DeliveryUrl();
        //$this->getS3EstablecimientoUrl();


        $this->resizedDeliveryImage = $this->dealWithImageConvertion($this->pathToDeliveryImage, $tiro['id'], 'delivery');
        $this->resizedEstablecimientoImage = $this->dealWithImageConvertion($this->pathToEstablecimientoImage, $tiro['id'], 'establecimiento');

        $this->urlDeliveryImage = $this->generateImageUrl($tiro['id'], 'delivery');
        $this->urlEstablecimientoImage = $this->generateImageUrl($tiro['id'], 'establecimiento');

        $this->getS3ResizedDeliveryUrl();
        $this->getS3ResizedEstablecimientoUrl();

        $this->dealWithDeliveryEvidence($tiro);
        $this->dealWithEstablecimientoEvidence($tiro);

        $this->fileHelper->removeFileFromLocal($this->pathToDeliveryImage);
        $this->fileHelper->removeFileFromLocal($this->pathToEstablecimientoImage);
        $this->fileHelper->removeFileFromLocal($this->resizedDeliveryImage);
        $this->fileHelper->removeFileFromLocal($this->resizedEstablecimientoImage);

        $updatedTiro = $this->tirosRepository->getTiroById($tiro);
        $updatedTiro->status = StatusConstants::TIRO_DONE;
        $updatedTiro->save();

        return $updatedTiro;

    }

    public function getS3DeliveryUrl()
    {
        $this->s3DeliveryUrl = Storage::disk('s3')->url($this->fileHelper->s3DeliveryImagePath);

        Log::debug("URL DELIVERY FILE $this->s3DeliveryUrl");
    }

    public function getS3EstablecimientoUrl()
    {
        $this->s3EstablecimientoUrl = Storage::disk('s3')->url($this->fileHelper->s3EstablecimientImagePath);

        Log::debug("URL Establecimiento Resize FILE $this->s3EstablecimientoUrl");
    }

    public function getS3ResizedDeliveryUrl()
    {
        $this->s3ResizedDeliveryUrl = Storage::disk('s3')->url($this->fileHelper->s3ResizedDeliveryImagePath);

        Log::debug("URL DELIVERY Resized FILE $this->s3ResizedDeliveryUrl");
    }

    public function getS3ResizedEstablecimientoUrl()
    {
        $this->s3ResizedEstablecimientoUrl = Storage::disk('s3')
            ->url($this->fileHelper->s3ResizedEstablecimientImagePath);

        Log::debug("URL Establecimiento FILE $this->s3EstablecimientoUrl");
    }

    public function dealWithImageConvertion(string $pathToImageToConvert, string $tiro_id, string $type = 'delivery')
    {
        $resizedImagePath = $this->imageHelper->convertImageFile($pathToImageToConvert, $tiro_id, $type);

        $type === 'delivery' ?
            $this->fileHelper->saveResizedDeliveryImageToS3($resizedImagePath, $tiro_id) :
            $this->fileHelper->saveResizedEstablecimientoImageToS3($resizedImagePath, $tiro_id);


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

        if (empty($foundDeliveryForTiro)) {

            $delivery = new Evidencia();

            $delivery->tiro_id = $tiroResource['id'];
            $delivery->fecha_evidencia = Carbon::now();
            $delivery->foto_url = $this->s3ResizedDeliveryUrl;
            $delivery->tipo = 'delivery';
            $delivery->original_image_path = $this->s3DeliveryUrl;
            $delivery->comentarios = $tiroResource['comentarios'];
            $delivery->gps_location_lat = $tiroResource['latitude'];
            $delivery->gps_location_long = $tiroResource['longitude'];
            $delivery->status = StatusConstants::AWAITING_STATUS;

            $delivery->save();


        } else {

            $foundDeliveryForTiro->fecha_evidencia = Carbon::now();
            $foundDeliveryForTiro->foto_url = $this->s3ResizedDeliveryUrl;
            $foundDeliveryForTiro->original_image_path = $this->s3DeliveryUrl;
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
            $establecimiento->foto_url = $this->s3ResizedEstablecimientoUrl;
            $establecimiento->tipo = 'establecimiento';
            $establecimiento->original_image_path = $this->s3EstablecimientoUrl;
            $establecimiento->comentarios = $tiroResource['comentarios'];
            $establecimiento->gps_location_lat = $tiroResource['latitude'];
            $establecimiento->gps_location_long = $tiroResource['longitude'];
            $establecimiento->status = StatusConstants::AWAITING_STATUS;

            $establecimiento->save();


        } else {

            $foundEstablecimientForTiro->fecha_evidencia = Carbon::now();
            $foundEstablecimientForTiro->foto_url = $this->s3ResizedEstablecimientoUrl;
            $foundEstablecimientForTiro->original_image_path = $this->s3EstablecimientoUrl;
            $foundEstablecimientForTiro->comentarios = $tiroResource['comentarios'];
            $foundEstablecimientForTiro->gps_location_lat = $tiroResource['latitude'];
            $foundEstablecimientForTiro->gps_location_long = $tiroResource['longitude'];
            $foundEstablecimientForTiro->status = StatusConstants::EVIDENCE_PROVIDED;

            $foundEstablecimientForTiro->save();

        }

    }

}
