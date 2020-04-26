<?php


namespace App\Imports;

use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;


class ExcelViajesTiroImport implements ToModel
{

    public function model(array $row): array
    {

        return [
            'ciudad'     => $row[0],
            'jefeDeSector' => $row[1],
            'delivery'    => $row[2],
            'nombre' => $row[3],
            'region' => $row[4],
            'fechaEntregaSolcitidada' => $row[5],
            'propuesta361' => $row[6],
        ];
    }
}

