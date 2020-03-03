<?php

namespace App;

use App\Traits\DefaultModelPropertiesChanger;
use Illuminate\Database\Eloquent\Model;

class Transportista extends Model
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
