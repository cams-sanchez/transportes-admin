<?php


namespace App\Repositories;

use App\Helpers\JsonHelper;
use App\Models\RepresentanteCliente;
use App\Models\Temporada;
use App\Constants\StatusConstants;
use Carbon\Carbon;

/**
 * Class TemporadaRepository
 * @package App\Repositories
 */
class TemporadaRepository
{
    /** @var Temporada $temporadaModel */
    protected $temporadaModel;

    /**
     * TemporadaRepository constructor.
     * @param Temporada $temporadaModel
     */
    public function __construct(Temporada $temporadaModel)
    {
        $this->temporadaModel = $temporadaModel;
    }

    /**
     * @return mixed
     */
    public function getAllTemporadas()
    {
        return $this->temporadaModel::where('status', '=', StatusConstants::ACTIVE_STATUS)->get();
    }

    /** @param array $temporada
     * @return Temporada
     */
    public function newTemporada(array $temporada)
    {

        $newTemporada = new Temporada();
        $representateCliente = RepresentanteCliente::where('nombre', '=', 'Jose Perez Leon')->first();

        $newTemporada->nombre = $temporada['nombre'];
        $newTemporada->descripcion = $temporada['descripcion'];
        $newTemporada->autorizado_por = $representateCliente->id;
        $newTemporada->fecha_inicio_estipulada = Carbon::now();
        $newTemporada->fecha_inicio_real = Carbon::now();
        $newTemporada->fecha_fin_estipulada = Carbon::now();
        $newTemporada->fecha_fin_real = Carbon::now();
        $newTemporada->status = StatusConstants::ACTIVE_STATUS;

        $newTemporada->save();

        return $newTemporada;
    }

    /**
     * @param array $temporada
     * @return Temporada
     */
    public function updateTemporada(array $temporada): Temporada
    {
        $foundTemporada = $this->searchTemporadaById($temporada['id']);

        $foundTemporada->nombre = $temporada['nombre'];
        $foundTemporada->unidadMetrica = $temporada['unidadMetrica'];
        $foundTemporada->descripcion = $temporada['descripcion'];

        $foundTemporada->save();

        return $foundTemporada;

    }

    /**
     * @param array $temporada
     * @return Temporada
     */
    public function deleteTemporada(array $temporada): Temporada
    {
        $foundTemporada = $this->searchTemporadaById($temporada['id']);

        $foundTemporada->status = StatusConstants::DELETE_STATUS;

        $foundTemporada->save();

        return $foundTemporada;
    }

    /**
     * @param string $temporadaId
     * @return mixed
     */
    public function searchTemporadaById(string $temporadaId)
    {
        return $this->temporadaModel::where('id', '=', $temporadaId)->get()->first();
    }
}
