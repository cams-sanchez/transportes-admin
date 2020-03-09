<?php

namespace App\Models;

use App\Traits\DefaultModelPropertiesChanger;
use Illuminate\Database\Eloquent\Model;

class TiposDeEstablecimiento extends Model
{
    use DefaultModelPropertiesChanger;

    public function establecimiento()
    {
        return $this->belongsTo('App\Models\EstablecimientoCatalog');
    }
}
