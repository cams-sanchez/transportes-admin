<?php

namespace App\Models;

use App\Traits\CreatedUpdatedAtDateFormat;
use App\Traits\UuidGenerator;
use Illuminate\Database\Eloquent\Model;

class DetallesDeCarga extends Model
{
    use UuidGenerator, CreatedUpdatedAtDateFormat;

    public function tiro()
    {
        return $this->belongsTo('App\Models\Tiro');
    }


}
