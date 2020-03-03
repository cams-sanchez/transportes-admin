<?php

namespace App;

use App\Traits\CreatedUpdatedAtDateFormat;
use App\Traits\UuidGenerator;
use Illuminate\Database\Eloquent\Model;

class TipoUsuarios extends Model
{
    use UuidGenerator, CreatedUpdatedAtDateFormat;

    public function usuario()
    {
        return $this->belongsTo('App\Models\User');
    }
}
