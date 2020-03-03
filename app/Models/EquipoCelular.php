<?php

namespace App\Models;

use App\Traits\CreatedUpdatedAtDateFormat;
use App\Traits\UuidGenerator;
use Illuminate\Database\Eloquent\Model;

class EquipoCelular extends Model
{
    use UuidGenerator, CreatedUpdatedAtDateFormat;

    public function operador()
    {
        return $this->belongsTo('App\Models\User');
    }
}
