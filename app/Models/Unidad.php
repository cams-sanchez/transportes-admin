<?php

namespace App\Models;

use App\Traits\DefaultModelPropertiesChanger;
use Illuminate\Database\Eloquent\Model;

class Unidad extends Model
{
    use DefaultModelPropertiesChanger;

    public function mantenimiento() {
        return $this->belongsTo('App\Models\Mantenimiento');
    }

    public function gastos_unidad() {
        return $this->hasMany('App\Models\GastosUnidad');
    }

    public function tiro() {
        return $this->belongsTo('App\Models\Tiro');
    }
}
