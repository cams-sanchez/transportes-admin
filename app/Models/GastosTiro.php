<?php

namespace App\Models;

use App\Traits\DefaultModelPropertiesChanger;
use Illuminate\Database\Eloquent\Model;

class GastosTiro extends Model
{
    use DefaultModelPropertiesChanger;

    public function tiro()
    {
        return $this->belongsTo('App\Models\Tiro');
    }

    public function tipos_gasto()
    {
        return $this->hasMany('App\Models\TiposDeGastoCatalog');
    }
}
