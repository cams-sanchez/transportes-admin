<?php

namespace App\Models;

use App\Traits\DefaultModelPropertiesChanger;
use Illuminate\Database\Eloquent\Model;

class EstablecimientosCatalog extends Model
{
    use DefaultModelPropertiesChanger;

    public function tiros()
    {
        return $this->hasOne('App\Models\Tiro');
    }

    public function tipo_establecimiento()
    {
        return $this->hasOne('App\Models\TipoDeEstablecimiento');
    }
}
