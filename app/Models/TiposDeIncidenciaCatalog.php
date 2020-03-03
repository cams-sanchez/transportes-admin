<?php

namespace App;

use App\Traits\DefaultModelPropertiesChanger;
use App\Traits\UuidGenerator;
use Illuminate\Database\Eloquent\Model;

class TiposDeIncidenciaCatalog extends Model
{
    use UuidGenerator, DefaultModelPropertiesChanger;

    public function evidencia()
    {
        return $this->belongsTo('App\Models\Evidencia');
    }
}
