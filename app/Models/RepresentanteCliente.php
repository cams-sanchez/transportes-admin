<?php

namespace App\Models;

use App\Traits\DefaultModelPropertiesChanger;
use App\Traits\UuidGenerator;
use Illuminate\Database\Eloquent\Model;

class RepresentanteCliente extends Model
{
    use UuidGenerator, DefaultModelPropertiesChanger;

    public function cliente()
    {
        return $this->belongsTo('App\Models\Cliente');
    }

    public function temporada()
    {
        return $this->hasOne('App\Models\Temporada');
    }
}
