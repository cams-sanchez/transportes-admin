<?php

namespace App\Models;

use App\Traits\DefaultModelPropertiesChanger;
use Illuminate\Database\Eloquent\Model;

class Incidente extends Model
{
    use DefaultModelPropertiesChanger;

    public function tiro()
    {
        return $this->belongsTo('App\Models\Tiro');
    }
}
