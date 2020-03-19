<?php

namespace App\Decorators;


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
    public function decorateAllTiposDeCargaResponse($tiposDeCarga)
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
}
