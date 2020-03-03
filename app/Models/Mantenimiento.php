<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UuidGenerator;

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
