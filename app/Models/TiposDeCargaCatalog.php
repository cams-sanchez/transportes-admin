<?php

namespace App\Models;

use App\Traits\CreatedUpdatedAtDateFormat;
use App\Traits\UuidGenerator;
use Illuminate\Database\Eloquent\Model;

class TiposDeCargaCatalog extends Model
{
    use UuidGenerator, CreatedUpdatedAtDateFormat;

    public function detalle_carga()
    {
        return $this->belongsTo('App\Models\DetallesDeCarga');
    }

    public function tipo_carga()
    {
        return $this->hasOne('App\Models\TipoDeCargaCatalog');
    }
}
