<?php

namespace App\Models;

use App\Traits\CreatedUpdatedAtDateFormat;
use App\Traits\UuidGenerator;
use Illuminate\Database\Eloquent\Model;

class TiposDeGastoCatalog extends Model
{
    use UuidGenerator, CreatedUpdatedAtDateFormat;

    public function gasto_tiro()
    {
        return $this->belongsTo('App\Models\GastosTiro');
    }

    public function gasto_unidad()
    {
        return $this->belongsTo('App\Models\GastosUnidad');
    }
}
