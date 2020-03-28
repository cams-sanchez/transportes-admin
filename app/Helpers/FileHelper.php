<?php


namespace App\Helpers;


use App\Imports\ExcelViajesTiroImport;
use App\Imports\UsersImport;
use Illuminate\Support\Facades\Log;
use Image;
use Maatwebsite\Excel\Facades\Excel;


class FileHelper
{
    public function saveUploadedFile(array $uplaodedFileResource)
    {
        $pathToSave = $uplaodedFileResource['evidenciaFile']->move(
            public_path("/uploadedImages/"), 'evidencia_' . $uplaodedFileResource['id'] . ".jpg"
        );

        Log::debug("Path To file " . print_r($pathToSave, true));


        Image::make($pathToSave)->resize(300, 200)->save(public_path("/uploadedImages/") . '_resized.jpg');


        $imageUrl = url("/uploadedImages/" . $uplaodedFileResource['id'] . ".jpg");

        Log::debug("Images URL $imageUrl");

        return $imageUrl;

    }

    public function uploadExcelFile(array $excelFileResource)
    {
        $pathToSave = $excelFileResource['excelFile']->move(
            public_path("/uploadedExcelFiles/"), 'TirosExcelFile.xlsx'
        );

        Log::debug("Path To file " . print_r($pathToSave, true));


        $excelInfo = Excel::toArray(new ExcelViajesTiroImport, '../public/uploadedExcelFiles/TirosExcelFile.xlsx');

        foreach ($excelInfo[0] as $key => $item) {

            if($key === 0){
                continue;
            }

            Log::debug("ARRAY INFO " . print_r($item, true));

            if ($key == 3) {
                break;
            }
        }

    }
}
