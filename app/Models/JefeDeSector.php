<?php

namespace App\Models;

use App\Traits\DefaultModelPropertiesChanger;
use App\Traits\UuidGenerator;
use Illuminate\Database\Eloquent\Model;

class JefeDeSector extends Model
{
    use UuidGenerator, DefaultModelPropertiesChanger;

    public function viajes()
    {
        return $this->hasMany('App\Models\Viaje');
    }
}
