<?php

namespace App;

use App\Traits\DefaultModelPropertiesChanger;
use Illuminate\Database\Eloquent\Model;

class TipoUsuarios extends Model
{
    use DefaultModelPropertiesChanger;

    public function usuario()
    {
        return $this->belongsTo('App\Models\User');
    }
}
