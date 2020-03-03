<?php

namespace App\Models;

use App\Traits\CreatedUpdatedAtDateFormat;
use App\Traits\UuidGenerator;
use Illuminate\Database\Eloquent\Model;

class JefeDeSector extends Model
{
    use UuidGenerator, CreatedUpdatedAtDateFormat;

    public function viajes()
    {
        return $this->hasMany('App\Models\Viaje');
    }
}
