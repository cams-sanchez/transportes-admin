<?php

namespace App;

use App\Traits\CreatedUpdatedAtDateFormat;
use App\Traits\UuidGenerator;
use Illuminate\Database\Eloquent\Model;

class TiposDeIncidenciaCatalog extends Model
{
    use UuidGenerator, CreatedUpdatedAtDateFormat;

    public function evidencia()
    {
        return $this->belongsTo('App\Models\Evidencia');
    }
}
