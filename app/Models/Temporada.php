<?php

namespace App\Models;

use App\Traits\DefaultModelPropertiesChanger;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UuidGenerator;

class Temporada extends Model
{
    use UuidGenerator, DefaultModelPropertiesChanger;

    public function representante_cliente()
    {
        return $this->belongsTo('App\Models\RepresentanteCliente');
    }

    public function trenes()
    {
        return $this->hasMany('App\Models\Tren');
    }
}
