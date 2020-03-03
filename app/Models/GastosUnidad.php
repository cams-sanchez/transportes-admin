<?php

namespace App\Models;

use App\Traits\DefaultModelPropertiesChanger;
use Illuminate\Database\Eloquent\Model;

class GastosUnidad extends Model
{
    use DefaultModelPropertiesChanger;

    public function unidad() {
        return $this->belongsTo('App\Models\Unidad');
    }

    public function tipo_gasto() {
        return $this->hasOne('App\Models\TipoDeGastoCatalog');
    }
}
