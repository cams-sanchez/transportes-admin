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
            'evidencia' => 'required|image|mimes:jpeg,jpg,png'
        ]
    ];


}

