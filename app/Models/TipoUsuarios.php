<?php

namespace App;

use App\Traits\DefaultModelPropertiesChanger;
use App\Traits\UuidGenerator;
use Illuminate\Database\Eloquent\Model;

class TipoUsuarios extends Model
{
    use UuidGenerator, DefaultModelPropertiesChanger;

    public function usuario()
    {
        return $this->belongsTo('App\Models\User');
    }
}
