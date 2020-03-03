<?php

namespace App;

use App\Traits\CreatedUpdatedAtDateFormat;
use App\Traits\UuidGenerator;
use Illuminate\Database\Eloquent\Model;

class Transportista extends Model
{
    use UuidGenerator, CreatedUpdatedAtDateFormat;

    public function user()
    {
        return $this->hasOne('App\Models\User');
    }

    public function estado_republica()
    {
        return $this->hasOne('App\Models\EstadosReplubicaCatalog');
    }

}
