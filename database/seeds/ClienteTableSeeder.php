<?php

use App\Models\EstadosReplubicaCatalog;
use Illuminate\Database\Seeder;
use App\Models\Cliente;

class ClienteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cliente = new Cliente();

        $estadoRep = EstadosReplubicaCatalog::where('estado', '=', 'Jalisco')->first();

        $cliente->nombre = 'Ferrero';
        $cliente->razon_social = 'Ferrero';
        $cliente->rfc = 'FERR0978657YU';
        $cliente->tipo_fiscal = 'fisica';
        $cliente->status = 'ACTIVO';
        $cliente->contacts = '';
        $cliente->calle= '';
        $cliente->num_ext = '';
        $cliente->num_int = '';;
        $cliente->cp = '';
        $cliente->estados_replubica_catalogs_id = $estadoRep->id;
        $cliente->municipio = '';
        $cliente->fiscal_calle = '';
        $cliente->fiscal_num_ext = '';
        $cliente->fiscal_num_int = '';;
        $cliente->fiscal_cp = '';
        $cliente->fiscal_estados_replubica_catalogs_id = null;
        $cliente->fiscal_municipio = '';

        $cliente->save();
    }
}
