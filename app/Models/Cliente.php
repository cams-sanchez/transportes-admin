<?php

namespace App\Models;

use App\Traits\DefaultModelPropertiesChanger;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use DefaultModelPropertiesChanger;

    public function representante_cliente()
    {
        return $this->hasOne('App\Models\RepresentanteCliente');
    }

    public function estado_republica()
    {
        return $this->hasOne('App\Models\EstadosReplubicaCatalog');
    }

    public function fiscal_estado_republica()
    {
        return $this->hasOne('App\Models\EstadosReplubicaCatalog');
    }

}
