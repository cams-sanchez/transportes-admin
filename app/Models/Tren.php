<?php

namespace App\Models;

use App\Traits\DefaultModelPropertiesChanger;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UuidGenerator;

class Tren extends Model
{
    use UuidGenerator, DefaultModelPropertiesChanger;

    public function temporada()
    {
        return $this->belongsTo('App\Models\Temporada');
    }

    public function viajes()
    {
        return $this->hasMany('App\Models\Viajes');
    }

}
