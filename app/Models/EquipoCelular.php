<?php

namespace App\Models;

use App\Traits\DefaultModelPropertiesChanger;
use Illuminate\Database\Eloquent\Model;

class EquipoCelular extends Model
{
    use DefaultModelPropertiesChanger;

    public function operador()
    {
        return $this->belongsTo('App\Models\User');
    }
}
