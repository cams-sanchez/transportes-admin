<?php

namespace App\Decorators;


use App\Models\TiposDeCargaCatalog;

/**
 * Class TiposDeCargaCatalogControllerDecorator
 * @package App\Decorators
 */
class TiposDeCargaCatalogControllerDecorator
{
    /** @var array $tiposDeCargaResponse */
    protected $tiposDeCargaResponse = [];

    /**
     * @param  $tiposDeCarga
     * @return array
     */
    public function decorateAllTiposDeCargaResponse($tiposDeCarga): array
    {

        foreach ($tiposDeCarga as $tipoDeCarga) {
            $this->tiposDeCargaResponse[] = [
                'id' => $tipoDeCarga->id,
                'nombre' => $tipoDeCarga->nombre,
                'unidadMetrica' => $tipoDeCarga->unidadMetrica,
                'descripcion' => $tipoDeCarga->descripcion,
            ];
        }

        return [
            'success' => true,
            'tiposDeCarga' => $this->tiposDeCargaResponse
        ];
    }


    public function decorateErrorValidationResponse(string $errorReponse): array
    {
        return ['sucess' => false, 'error' => $errorReponse];
    }

    public function decorateResponseTipoDeCarga(TiposDeCargaCatalog $newTipoDeCarga): array
    {
        return [
            'sucess' => true,
            'tipoDeCarga' => [
                'nombre' => $newTipoDeCarga->nombre,
                'unidadMetrica' => $newTipoDeCarga->unidadMetrica,
                'descripcion' => $newTipoDeCarga->descripcion,
                'status' => $newTipoDeCarga->status,
            ]
        ];
    }
}
