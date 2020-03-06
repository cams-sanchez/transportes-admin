<?php

namespace App\Models;

use App\Traits\DefaultModelPropertiesChanger;
use Illuminate\Database\Eloquent\Model;

class Viaje extends Model
{
    use DefaultModelPropertiesChanger;

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

    public function estado_republica()
    {
        return $this->hasOne('App\Models\EstadosReplubicaCatalog');
    }
}
