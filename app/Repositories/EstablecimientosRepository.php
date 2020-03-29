<?php


namespace App\Repositories;


use App\Models\EstablecimientosCatalog;

class EstablecimientosRepository
{

    /** @var EstablecimientosCatalog $establecimientosCatalog */
    protected EstablecimientosCatalog $establecimientosCatalog;


    public function __construct(EstablecimientosCatalog $establecimientosCatalog)
    {
        $this->establecimientosCatalog = $establecimientosCatalog;
    }

    public function getEstablecimientoById(string $id)
    {
        return $this->establecimientosCatalog::where('id', '=', $id)->get()->first();
    }

    public function getEstablecimientoByName(string $establecimiento)
    {
        return $this->establecimientosCatalog::where('nombre', '=', $establecimiento)->get()->first();
    }
}
