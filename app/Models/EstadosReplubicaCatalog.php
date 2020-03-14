<?php

namespace App\Models;

use App\Traits\DefaultModelPropertiesChanger;
use Illuminate\Database\Eloquent\Model;

class EstadosReplubicaCatalog extends Model
{
    use DefaultModelPropertiesChanger;

    public function company()
    {
        return $this->belongsTo('App\Models\Company');
    }

    public function cliente()
    {
        return $this->belongsTo('App\Models\Cliente');
    }

    public function transportista()
    {
        return $this->belongsTo('App\Models\Transportista');
    }

    public function viaje()
    {
        return $this->belongsTo('App\Models\Viaje');
    }

    public function user()
    {
        return $this->hasOne('App\Models\User');
    }
}
