<?php

namespace App\Models;

use App\Traits\CreatedUpdatedAtDateFormat;
use App\Traits\UuidGenerator;
use Illuminate\Database\Eloquent\Model;

class Evidencia extends Model
{
    use UuidGenerator, CreatedUpdatedAtDateFormat;

    public function tiro()
    {
        return $this->belongsTo('App\Models\Tiro');
    }

    public function tipo_incidencia()
    {
        return $this->hasOne('App\Models\TiposDeIncidenciaCatalog');
    }
}
