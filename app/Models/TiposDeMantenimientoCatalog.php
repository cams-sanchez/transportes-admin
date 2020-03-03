<?php

namespace App\Models;

use App\Traits\DefaultModelPropertiesChanger;
use Illuminate\Database\Eloquent\Model;

class TiposDeMantenimientoCatalog extends Model
{
    use DefaultModelPropertiesChanger;

    public function mantenimiento() {
        return $this->belongsTo('App\Models\Mantenimiento');
    }

}
