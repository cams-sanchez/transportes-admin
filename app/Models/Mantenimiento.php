<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mantenimiento extends Model
{
    use UuidGenerator;

    public function tipo_mantenimiento() {
        return $this->hasOne('App\Models\TiposDeMantenimientoCatalog');
    }

    public function unidades() {
        return $this->hasMany('App\Models\Unidad');
    }
}
