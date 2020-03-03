<?php

namespace App\Models;

use App\Traits\CreatedUpdatedAtDateFormat;
use App\Traits\UuidGenerator;
use Illuminate\Database\Eloquent\Model;

class Tiro extends Model
{
    use UuidGenerator, CreatedUpdatedAtDateFormat;

    public function viaje()
    {
        return $this->belongsTo('App\Models\Viaje');
    }

    public function incidentes()
    {
        return $this->hasMany('App\Models\Incidente');
    }

    public function evidencias()
    {
        return $this->hasMany('App\Models\Evidencia');
    }

    public function establecimiento()
    {
        return $this->belongsTo('App\Models\Establecimiento');
    }

    public function detalles_carga()
    {
        return $this->hasOne('App\Models\DetallesDeCarga');
    }

    public function factura()
    {
        return $this->hasOne('App\Models\Factura');
    }

    public function operador()
    {
        return $this->hasOne('App\Models\User');
    }

    public function gastos()
    {
        return $this->hasMany('App\Models\GastosTiro');
    }

    public function unidad()
    {
        return $this->hasOne('App\Models\Unidad');
    }
}
