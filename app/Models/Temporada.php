<?php

namespace App\Models;

use App\Traits\DefaultModelPropertiesChanger;
use Illuminate\Database\Eloquent\Model;

class Temporada extends Model
{
    use DefaultModelPropertiesChanger;

    public function representante_cliente()
    {
        return $this->belongsTo('App\Models\RepresentanteCliente');
    }

    public function trenes()
    {
        return $this->hasMany('App\Models\Tren');
    }
}
