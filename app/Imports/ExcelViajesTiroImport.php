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
            'delivery'    => $row[1],
            'jefeDeSector' => $row[2],
            'solic' => $row[3],
            'nombre' => $row[4],
            'doc' => $row[5],
            'region' => $row[6],
            'fechaEntregaSolcitidada' => $row[7],
            'propuesta361' => Carbon::createFromFormat('Y-m-d H:i:s', $row[9]),
            'observaciones' => Carbon::createFromFormat('Y-m-d H:i:s', $row[10]),
        ];
    }
}

