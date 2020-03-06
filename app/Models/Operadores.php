<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Operadores extends Model
{
    public function operador()
    {
        return $this->hasOne('App\Models\User');
    }

    public function viaje()
    {
        return$this->hasOne('App\Models\Viaje');
    }

    public function tiro()
    {
        return$this->hasOne('App\Models\Tiro');
    }
}
