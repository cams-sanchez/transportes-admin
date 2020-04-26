<?php

namespace App\Decorators;


use App\Models\Tiro;
use App\Decorators\GenericResponsesDecorator;
use Illuminate\Support\Facades\Log;

/**
 * Class TiroControllerDecorator
 * @package App\Decorators
 */
class TemporadaControllerDecorator extends GenericResponsesDecorator
{
    /** @var array $temporadasResponse */
    protected $temporadasResponse = [];

    /** @var array $evidencias */
    protected $evidencias = [];

    /**
     * @param  object $temporadas
     * @param array $statisctics
     * @return array
     */
    public function decorateAllTemporadasResponse(object $temporadas, array $statisctics = []): array
    {

        foreach ($temporadas as $temporada) {

            $this->temporadasResponse[] = [
                'id' => $temporada->id,
                'nombre' => $temporada->nombre,
                'descripcion' => $temporada->descripcion,
                'autorizado_por' => $temporada->autorizado_por,
                'fecha_inicio_estipulada' => $temporada->fecha_inicio_estipulada,
                'fecha_inicio_real' => $temporada->fecha_inicio_real,
                'fecha_fin_estipulada' => $temporada->fecha_fin_estipulada,
                'fecha_fin_real' => $temporada->fecha_fin_real,
                'status' => $temporada->status,
            ];
        }

        return [
            'success' => true,
            'temporadas' => $this->temporadasResponse,
            'statistics' => $statisctics
        ];
    }

    /**
     * @param  $temporada
     * @return array
     */
    public function decorateTemporadaResponse($temporada): array
    {

        $this->temporadasResponse[] = [
            'id' => $temporada->id,
            'nombre' => $temporada->nombre,
            'descripcion' => $temporada->descripcion,
            'autorizado_por' => $temporada->autorizado_por,
            'fecha_inicio_estipulada' => $temporada->fecha_inicio_estipulada,
            'fecha_inicio_real' => $temporada->fecha_inicio_real,
            'fecha_fin_estipulada' => $temporada->fecha_fin_estipulada,
            'fecha_fin_real' => $temporada->fecha_fin_real,
            'status' => $temporada->status,
        ];

        return [
            'success' => true,
            'temporada' => $this->temporadasResponse
        ];
    }
}
