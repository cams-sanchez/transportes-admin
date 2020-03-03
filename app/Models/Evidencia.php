<?php

namespace App\Models;

use App\Traits\DefaultModelPropertiesChanger;
use Illuminate\Database\Eloquent\Model;

class Evidencia extends Model
{
    use DefaultModelPropertiesChanger;

    public function tiro()
    {
        return $this->belongsTo('App\Models\Tiro');
    }

    public function tipo_incidencia()
    {
        return $this->hasOne('App\Models\TiposDeIncidenciaCatalog');
    }
}
