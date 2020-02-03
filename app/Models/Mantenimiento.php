<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UuidGenerator;

class Mantenimiento extends Model
{
    use UuidGenerator;

    public function tipoDeMantenimiento() {
        return $this->hasMany('App\Models\TiposDeMantenimientoCatalog');
    }

    public function unidad() {
        return $this->hasMany('App\Models\Unidad');
    }
}
