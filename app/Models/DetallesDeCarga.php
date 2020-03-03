<?php

namespace App\Models;

use App\Traits\DefaultModelPropertiesChanger;
use App\Traits\UuidGenerator;
use Illuminate\Database\Eloquent\Model;

class DetallesDeCarga extends Model
{
    use UuidGenerator, DefaultModelPropertiesChanger;

    public function tiro()
    {
        return $this->belongsTo('App\Models\Tiro');
    }


}
