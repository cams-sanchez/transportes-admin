<?php


namespace App\Helpers;


use App\Constants\FileConstants;
use Illuminate\Support\Facades\Log;
use Image;

class ImageFileHelper
{

    public function convertImageFile(string $pathToFile, string $tiro_id, string $type = 'delivery')
    {
        $image = Image::make($pathToFile)->resize(FileConstants::EVIDENCE_WIDTH_RESIZE, FileConstants::EVIDENCE_HEIGHT_RESIZE);

        $imagePrefix = ($type === 'delivery') ?
            FileConstants::EVIDENCE_DELIVERY_SAVED_PREFIX :
            FileConstants::EVIDENCE_ESTABLECIMIENTO_SAVED_PREFIX;

        $imageNewPathSave = public_path(FileConstants::EVIDENCE_DIRECTORY) .
            $imagePrefix .
            $tiro_id .
            FileConstants::EVIDENCE_RESIZED_FILE_SUFFIX .
            FileConstants::EVIDENCE_RESIZED_EXTENSION;

        Log::debug("IMAGE PATH TO SAVE $imageNewPathSave");

        $image->save($imageNewPathSave, 90, 'png');

        return $imageNewPathSave;
    }
}
