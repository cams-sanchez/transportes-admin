<?php

namespace App;

use App\Traits\DefaultModelPropertiesChanger;
use App\Traits\UuidGenerator;
use Illuminate\Database\Eloquent\Model;


class Company extends Model
{
    use UuidGenerator, DefaultModelPropertiesChanger;

    public function user()
    {
        return $this->hasOne('App\Models\User');
    }

    public function estado_republica()
    {
        return $this->hasOne('App\Models\EstadosReplubicaCatalog');
    }
}
