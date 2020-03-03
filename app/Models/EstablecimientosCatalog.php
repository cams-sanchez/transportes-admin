<?php

namespace App\Models;

use App\Traits\CreatedUpdatedAtDateFormat;
use App\Traits\UuidGenerator;
use Illuminate\Database\Eloquent\Model;

class EstablecimientosCatalog extends Model
{
    use UuidGenerator, CreatedUpdatedAtDateFormat;

    public function tiros()
    {
        return $this->hasOne('App\Models\Tiro');
    }
}
