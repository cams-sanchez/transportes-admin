<?php

namespace App\Models;

use App\Traits\DefaultModelPropertiesChanger;
use Illuminate\Database\Eloquent\Model;


class Company extends Model
{
    use DefaultModelPropertiesChanger;

    public function user()
    {
        return $this->hasOne('App\Models\User');
    }

    public function estado_republica()
    {
        return $this->hasOne('App\Models\EstadosReplubicaCatalog');
    }
}
