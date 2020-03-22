<?php

namespace App\Decorators;


use App\Models\Tiro;
use App\Decorators\GenericResponsesDecorator;

/**
 * Class TiroControllerDecorator
 * @package App\Decorators
 */
class TiroControllerDecorator extends GenericResponsesDecorator
{
    /** @var array $tirosResponse */
    protected $tirosResponse = [];

    /**
     * @param  $tiros
     * @return array
     */
    public function decorateAllTirosResponse($tiros): array
    {

        foreach ($tiros as $tiro) {
            $this->tirosResponse[] = [
                'id' => $tiro->id,
                'viaje_id' => $tiro->viaje_id,
                'unidad_id' => $tiro->unidad_id,
                'establecimiento_id' => $tiro->establecimiento_id,
                'tipo_carga_id' => $tiro->tipo_carga_id,
                'cantidad' => $tiro->cantidad,
                'delivery' => $tiro->delivery,
                'solicitud' => $tiro->solicitud,
                'numero_de_pedido' => $tiro->numero_de_pedido,
                'notas' => $tiro->notas,
                'status' => $tiro->status,

            ];
        }

        return [
            'success' => true,
            'tiros' => $this->tirosResponse
        ];
    }

    /**
     * @param  $tiros
     * @return array
     */
    public function decorateTiroResponse($tiro): array
    {

        $this->tirosResponse[] = [
            'id' => $tiro->id,
            'viaje_id' => $tiro->viaje_id,
            'unidad_id' => $tiro->unidad_id,
            'establecimiento_id' => $tiro->establecimiento_id,
            'tipo_carga_id' => $tiro->tipo_carga_id,
            'cantidad' => $tiro->cantidad,
            'delivery' => $tiro->delivery,
            'solicitud' => $tiro->solicitud,
            'numero_de_pedido' => $tiro->numero_de_pedido,
            'notas' => $tiro->notas,
            'status' => $tiro->status,

        ];
        return [
            'success' => true,
            'tiro' => $this->tirosResponse
        ];
    }

}
