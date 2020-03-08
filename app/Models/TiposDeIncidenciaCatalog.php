<?php

namespace App\Models;

use App\Traits\DefaultModelPropertiesChanger;
use Illuminate\Database\Eloquent\Model;

class TiposDeIncidenciaCatalog extends Model
{
    use DefaultModelPropertiesChanger;

    public function evidencia()
    {
        return $this->belongsTo('App\Models\Evidencia');
    }
}
