<?php

namespace App\Models;

use App\Traits\DefaultModelPropertiesChanger;
use Illuminate\Database\Eloquent\Model;

class Tiro extends Model
{
    use DefaultModelPropertiesChanger;

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

    public function operador()
    {
        return $this->belongsTo(('App\Models\Operadores'));
    }

    public function detalles_carga()
    {
        return $this->hasMany('App\Models\DetallesDeCarga');
    }

    public function factura()
    {
        return $this->hasMany('App\Models\Factura');
    }

    public function gastos()
    {
        return $this->hasMany('App\Models\GastosTiro');
    }

    public function unidad()
    {
        return $this->hasMany('App\Models\Unidad');
    }
}
