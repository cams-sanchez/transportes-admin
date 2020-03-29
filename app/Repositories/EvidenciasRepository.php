<?php


namespace App\Repositories;


use App\Models\Evidencia;

class EvidenciasRepository
{
    protected $evidencia;

    public function __construct(Evidencia $evidencia)
    {
        $this->evidencia = $evidencia;
    }

    public function getEvidenciasForTiroId(string $tiro)
    {
        return $this->evidencia::where('tiro_id', '=', $tiro)->get()->first();
    }

    public function getDeliveryEvidenciaForTiroId(string $tiro)
    {
        return $this->evidencia::
                where('tiro_id', '=', $tiro)->
                where('tipo', '=', 'delivery')->
                get()->first();
    }

    public function getEstablecimientoEvidenciaForTiroId(string $tiro)
    {
        return $this->evidencia::
                where('tiro_id', '=', $tiro)->
                where('tipo', '=', 'establecimiento')->
                get()->first();

    }
}
