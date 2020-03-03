<?php

namespace App\Models;

use App\Traits\DefaultModelPropertiesChanger;
use Illuminate\Database\Eloquent\Model;

class RepresentanteCliente extends Model
{
    use DefaultModelPropertiesChanger;

    public function cliente()
    {
        return $this->belongsTo('App\Models\Cliente');
    }

    public function temporada()
    {
        return $this->hasOne('App\Models\Temporada');
    }
}
