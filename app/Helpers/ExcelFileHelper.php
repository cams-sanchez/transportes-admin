<?php


namespace App\Helpers;


use App\Imports\ExcelViajesTiroImport;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class ExcelFileHelper
{
    public function readExcelFileInfoFromFile(string $filePath)
    {
        $excelInfo = Excel::toArray(new ExcelViajesTiroImport, $filePath);
        $arrayInfo = [];

        foreach ($excelInfo[0] as $key => $item) {

            if($key === 0){
                continue;
            }

            $arrayInfo[] = $item;

            Log::debug("ARRAY INFO " . print_r($item, true));

            /*if ($key == 3) {
                break;
            }*/
        }

        return $arrayInfo;
    }
}
