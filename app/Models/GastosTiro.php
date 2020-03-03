<?php

namespace App;

use App\Traits\CreatedUpdatedAtDateFormat;
use App\Traits\UuidGenerator;
use Illuminate\Database\Eloquent\Model;

class GastosTiro extends Model
{
    use UuidGenerator, CreatedUpdatedAtDateFormat;

    public function tiro()
    {
        return $this->belongsTo('App\Models\Tiro');
    }

    public function tipos_gasto()
    {
        return $this->hasMany('App\Models\TiposDeGastoCatalog');
    }
}
