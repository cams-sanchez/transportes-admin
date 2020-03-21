<?php

namespace App\Helpers;

use App\Decorators\TiposDeCargaCatalogControllerDecorator;
use Illuminate\Support\Facades\Log;

class TipoDeCargaCatalogValidatorHelper
{

    protected $decorator;

    protected $rules = [
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

    public function __construct(TiposDeCargaCatalogControllerDecorator $decorator)
    {
        $this->decorator = $decorator;
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function getRules(string $rulesToValidate = 'new'): array
    {
        return $this->rules[$rulesToValidate];
    }

}
