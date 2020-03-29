<?php


namespace App\Repositories;


use App\Models\EstadosReplubicaCatalog;


class EstadosRepublicaRepository
{

    /** @var EstadosReplubicaCatalog $estadosReplubicaCatalog */
    protected $estadosReplubicaCatalog;


    /**
     * EstadosRepublicaRepository constructor.
     * @param EstadosReplubicaCatalog $estadosReplubicaCatalog
     */
    public function __construct(EstadosReplubicaCatalog $estadosReplubicaCatalog)
    {
        $this->estadosReplubicaCatalog = $estadosReplubicaCatalog;
    }

    /**
     * @param string $id
     * @return mixed
     */
    public function getEstadoById(string $id)
    {
        return $this->estadosReplubicaCatalog::where('id', '=', $id)->get()->first();
    }

    /**
     * @param string $estado
     * @return mixed
     */
    public function getEstadoByName(string $estado)
    {
        return $this->estadosReplubicaCatalog::where('estado', '=', $estado)->get()->first();
    }
}
