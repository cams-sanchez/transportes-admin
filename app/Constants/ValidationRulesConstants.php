<?php

namespace App\Constants;

class ValidationRulesConstants
{

    public const  TIPOS_DE_CARGA_RULES = [
        'new' => [
            'nombre' => 'required',
            'unidadMetrica' => 'required',
        ],
        'edit' => [
            'id' => 'required',
            'nombre' => 'required',
            'unidadMetrica' => 'required',
        ],
        'delete' => [
            'id' => 'required',
        ]
    ];

    public const  TIROS_RULES = [
        'delete' => [
            'id' => 'required',
        ],
        'upload' => [
            'id' => 'required',
            'delivery' => 'required|image|mimes:jpeg,jpg,png',
            'establecimiento' => 'required|image|mimes:jpeg,jpg,png'
        ],
        'uploadExcel' => [
            'excelFile' => 'required|mimes:xls,xlsx'
        ]
    ];


}

