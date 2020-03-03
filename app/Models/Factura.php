<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    public function tiro()
    {
        return $this->belongsTo('App\Models\Tiro');
    }
}
