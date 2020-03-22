<?php

namespace App\Decorators;


use App\Models\TiposDeCargaCatalog;
use App\Decorators\GenericResponsesDecorator;
/**
 * Class TiposDeCargaCatalogControllerDecorator
 * @package App\Decorators
 */
class TiposDeCargaCatalogControllerDecorator extends GenericResponsesDecorator
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
