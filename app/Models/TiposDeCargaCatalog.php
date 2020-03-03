<?php

namespace App\Models;

use App\Traits\DefaultModelPropertiesChanger;
use App\Traits\UuidGenerator;
use Illuminate\Database\Eloquent\Model;

class TiposDeCargaCatalog extends Model
{
    use UuidGenerator, DefaultModelPropertiesChanger;

    public function detalle_carga()
    {
        return $this->belongsTo('App\Models\DetallesDeCarga');
    }

    public function tipo_carga()
    {
        return $this->hasOne('App\Models\TipoDeCargaCatalog');
    }
}
