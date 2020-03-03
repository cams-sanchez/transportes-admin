<?php

namespace App\Models;

use App\Traits\DefaultModelPropertiesChanger;
use App\Traits\UuidGenerator;
use Illuminate\Database\Eloquent\Model;

class Viaje extends Model
{
    use UuidGenerator, DefaultModelPropertiesChanger;

    public function tren()
    {
        return $this->belongsTo('App\Models\Tren');
    }

    public function tiros()
    {
        return $this->hasMany('App\Models\Tiro');
    }

    public function jefe_sector()
    {
        return $this->belongsTo('App\Models\JefeDeSector');
    }

    public function operador_principal()
    {
        return $this->hasOne('App\Models\User');
    }

    public function estado_republica()
    {
        return $this->hasOne('App\Models\EstadosReplubicaCatalog');
    }
}
