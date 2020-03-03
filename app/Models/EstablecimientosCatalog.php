<?php

namespace App\Models;

use App\Traits\DefaultModelPropertiesChanger;
use App\Traits\UuidGenerator;
use Illuminate\Database\Eloquent\Model;

class EstablecimientosCatalog extends Model
{
    use UuidGenerator, DefaultModelPropertiesChanger;

    public function tiros()
    {
        return $this->hasOne('App\Models\Tiro');
    }
}
