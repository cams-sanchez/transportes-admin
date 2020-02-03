<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UuidGenerator;

class GastosUnidad extends Model
{
    use UuidGenerator;

    public function unidad() {
        return $this->belongsTo('App\Models\Unidad');
    }
}
