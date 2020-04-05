<?php

namespace App\Decorators;


use App\Models\Tiro;
use App\Decorators\GenericResponsesDecorator;
use Illuminate\Support\Facades\Log;

/**
 * Class TiroControllerDecorator
 * @package App\Decorators
 */
class TiroControllerDecorator extends GenericResponsesDecorator
{
    /** @var array $tirosResponse */
    protected $tirosResponse = [];

    /** @var array $evidencias */
    protected $evidencias = [];

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
            'viaje' => $tiro->viaje->nombre,
            'ciudad'=>$tiro->ciudad,
            'unidad' => $tiro->unidad->nombre,
            'establecimiento' => $tiro->establecimiento->nombre,
            'tipo_carga_id' => $tiro->tipo_carga_id,
            'cantidad' => $tiro->cantidad,
            'delivery' => $tiro->delivery,
            'epv' => $tiro->epv,
            'jefe_de_sector' => $tiro->jefeDeSector->nombre,
            'sdic' => $tiro->sdic,
            'doc' => $tiro->doc,
            'region' => $tiro->region,
            'fecha_entrega_solicitada' => $tiro->fecha_entrega_solicitada,
            'propuesta_361' => $tiro->propuesta_361,
            'notas' => $tiro->notas,
            'status' => $tiro->status,
            'evidencias' =>$tiro->evidencias,
        ];

        return [
            'success' => true,
            'tiro' => $this->tirosResponse
        ];
    }
}
