<?php


namespace App\Helpers;


use Illuminate\Support\Facades\Log;
use Image;

class FileHelper
{
    public function saveUploadedFile(array $uplaodedFileResource)
    {
        $pathToSave = $uplaodedFileResource['evidenciaFile']->move(
            public_path("/uploadedImages/"), 'evidencia_' . $uplaodedFileResource['id'] . ".jpg"
        );

        Log::debug("Path To file " . print_r($pathToSave, true));


        Image::make($pathToSave)->resize(300, 200)->save(public_path("/uploadedImages/"). '_resized.jpg');


        $imageUrl = url("/uploadedImages/" . $uplaodedFileResource['id'] . ".jpg");

        Log::debug("Images URL $imageUrl");

        return $imageUrl;

    }
}
