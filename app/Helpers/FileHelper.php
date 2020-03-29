<?php


namespace App\Helpers;

use App\Constants\FileConstants;
use App\Imports\UsersImport;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;


class FileHelper
{
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
                FileConstants::EXCEL_SAVED_NAME.Carbon::now().FileConstants::EXCEL_EXTENSION
            );

        Log::debug("Path To Excel file " . print_r($pathToSave, true));

        return $pathToSave;

    }
}
