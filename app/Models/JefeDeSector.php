<?php

namespace App\Models;

use App\Traits\DefaultModelPropertiesChanger;
use Illuminate\Database\Eloquent\Model;

class JefeDeSector extends Model
{
    use DefaultModelPropertiesChanger;

    public function viajes()
    {
        return $this->hasMany('App\Models\Viaje');
    }
}
