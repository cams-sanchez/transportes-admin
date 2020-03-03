<?php

namespace App\Models;

use App\Traits\DefaultModelPropertiesChanger;
use Illuminate\Database\Eloquent\Model;

class TiposDeCargaCatalog extends Model
{
    use DefaultModelPropertiesChanger;

    public function detalle_carga()
    {
        return $this->belongsTo('App\Models\DetallesDeCarga');
    }

    public function tipo_carga()
    {
        return $this->hasOne('App\Models\TipoDeCargaCatalog');
    }
}
