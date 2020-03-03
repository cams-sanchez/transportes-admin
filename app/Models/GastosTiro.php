<?php

namespace App;

use App\Traits\DefaultModelPropertiesChanger;
use App\Traits\UuidGenerator;
use Illuminate\Database\Eloquent\Model;

class GastosTiro extends Model
{
    use UuidGenerator, DefaultModelPropertiesChanger;

    public function tiro()
    {
        return $this->belongsTo('App\Models\Tiro');
    }

    public function tipos_gasto()
    {
        return $this->hasMany('App\Models\TiposDeGastoCatalog');
    }
}
