<?php

namespace App\Models;

use App\Traits\DefaultModelPropertiesChanger;
use Illuminate\Database\Eloquent\Model;

class TipoUsuarios extends Model
{
    use DefaultModelPropertiesChanger;

    public function user()
    {
        return $this->hasOne('App\Models\User');
    }
}
