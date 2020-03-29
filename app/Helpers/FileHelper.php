<?php


namespace App\Helpers;

use App\Constants\FileConstants;
use App\Imports\UsersImport;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;


class FileHelper
{
    /** @var Carbon $dateTime */
    public Carbon $dateTime;

    /** @var string $s3ExcelFilePath */
    public string $s3ExcelFilePath;

    /** @var string $s3DeliveryImagePath */
    public string $s3DeliveryImagePath;

    /** @var string $s3EstablecimientImagePath */
    public string $s3EstablecimientImagePath;

    /** @var string $s3ResizedDeliveryImagePath */
    public string $s3ResizedDeliveryImagePath;

    /** @var string $s3ResizedEstablecimientImagePath */
    public string $s3ResizedEstablecimientImagePath;


    public function __construct()
    {
        $this->dateTime = Carbon::now();
    }

    public function saveUploadDeliveryImage(array $uploadResource)
    {
        $pathToSaveDeliveryImage = $uploadResource['delivery']->move(
            public_path(FileConstants::EVIDENCE_DIRECTORY),
            FileConstants::EVIDENCE_DELIVERY_SAVED_PREFIX . $uploadResource['id'] .
            FileConstants::IMAGE_EXTENSION
        );


        Log::debug("Path To Delivery Image file " . print_r($pathToSaveDeliveryImage, true));

        return $pathToSaveDeliveryImage;
    }

    public function saveDeliveryImageToS3(string $localPath, string $tiro_id)
    {
        $this->s3DeliveryImagePath = FileConstants::S3_ORIGINAL_IMAGES .
            FileConstants::EVIDENCE_DELIVERY_SAVED_PREFIX .
            $tiro_id .
            FileConstants::IMAGE_EXTENSION;

        return Storage::disk('s3')->put(
            $this->s3DeliveryImagePath,
            file_get_contents($localPath));
    }

    public function saveEstablecimientoImageToS3(string $localPath, string $tiro_id)
    {
        $this->s3EstablecimientImagePath = FileConstants::S3_ORIGINAL_IMAGES .
            FileConstants::EVIDENCE_ESTABLECIMIENTO_SAVED_PREFIX .
            $tiro_id .
            FileConstants::IMAGE_EXTENSION;

        return Storage::disk('s3')->put(
            $this->s3EstablecimientImagePath,
            file_get_contents($localPath));
    }

    public function saveResizedDeliveryImageToS3(string $localPath, string $tiro_id)
    {
        $this->s3ResizedDeliveryImagePath = FileConstants::S3_RESIZED_IMAGES .
            FileConstants::EVIDENCE_DELIVERY_SAVED_PREFIX .
            $tiro_id .
            FileConstants::EVIDENCE_RESIZED_FILE_SUFFIX .
            FileConstants::EVIDENCE_RESIZED_EXTENSION;

        return Storage::disk('s3')->put(
            $this->s3ResizedDeliveryImagePath,
            file_get_contents($localPath));
    }

    public function saveResizedEstablecimientoImageToS3(string $localPath, string $tiro_id)
    {
        $this->s3ResizedEstablecimientImagePath = FileConstants::S3_RESIZED_IMAGES .
            FileConstants::EVIDENCE_ESTABLECIMIENTO_SAVED_PREFIX .
            $tiro_id .
            FileConstants::EVIDENCE_RESIZED_FILE_SUFFIX .
            FileConstants::EVIDENCE_RESIZED_EXTENSION;

        return Storage::disk('s3')->put(
            $this->s3ResizedEstablecimientImagePath,
            file_get_contents($localPath));
    }

    public function saveUploadEstablecimientoImage(array $uploadResource)
    {
        $pathToSaveDeliveryImage = $uploadResource['establecimiento']->move(
            public_path(FileConstants::EVIDENCE_DIRECTORY),
            FileConstants::EVIDENCE_ESTABLECIMIENTO_SAVED_PREFIX . $uploadResource['id'] .
            FileConstants::IMAGE_EXTENSION
        );

        Log::debug("Path To Establecimiento Image file " . print_r($pathToSaveDeliveryImage, true));

        return $pathToSaveDeliveryImage;
    }

    public function uploadExcelFile(array $excelFileResource)
    {
        $pathToSave = $excelFileResource['excelFile']->move(
            public_path(
                FileConstants::EXCEL_DIRECTORY),
            FileConstants::EXCEL_SAVED_NAME .
            $this->dateTime .
            FileConstants::EXCEL_EXTENSION
        );

        Log::debug("Path To Excel file " . print_r($pathToSave, true));

        return $pathToSave;

    }

    public function saveExcelFileToS3(string $localPath)
    {
        $this->s3ExcelFilePath = FileConstants::S3_EXCEL_FOLDER .
            FileConstants::EXCEL_SAVED_NAME .
            $this->dateTime .
            FileConstants::EXCEL_EXTENSION;

        Storage::disk('s3')->put(
            $this->s3ExcelFilePath,
            file_get_contents($localPath));
    }

    public function removeFileFromLocal(string $filePath)
    {
        unlink($filePath);
    }
}
