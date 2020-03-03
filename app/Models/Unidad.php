<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UuidGenerator;

class Unidad extends Model
{
    use UuidGenerator;

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
