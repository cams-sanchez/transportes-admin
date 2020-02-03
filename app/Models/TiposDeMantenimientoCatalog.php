<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UuidGenerator;

class TiposDeMantenimientoCatalog extends Model
{
    use UuidGenerator;

    public function mantenimiento() {
        return $this->belongsTo('App\Models\Mantenimiento');
    }

}
