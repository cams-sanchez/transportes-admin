<?php


namespace App\Helpers;


use App\Imports\ExcelViajesTiroImport;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class ExcelFileHelper
{
    public function readExcelFileInfo(string $filePath)
    {
        $importObject = new ExcelViajesTiroImport;
        $excelInfo = Excel::toArray($importObject, $filePath);
        $arrayInfo = [];

        foreach ($excelInfo[0] as $key => $item) {

            if($key === 0){
                continue;
            }

            $arrayInfo[] = $importObject->model($item);

        }

        return $arrayInfo;
    }
}
