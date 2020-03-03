<?php

namespace App\Models;

use App\Traits\DefaultModelPropertiesChanger;
use App\Traits\UuidGenerator;
use Illuminate\Database\Eloquent\Model;

class EquipoCelular extends Model
{
    use UuidGenerator, DefaultModelPropertiesChanger;

    public function operador()
    {
        return $this->belongsTo('App\Models\User');
    }
}
