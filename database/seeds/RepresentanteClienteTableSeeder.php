<?php

use App\Models\Cliente;
use App\Models\RepresentanteCliente;
use Illuminate\Database\Seeder;

class RepresentanteClienteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $representanteCliente = new RepresentanteCliente();

        $cliente = Cliente::where('nombre', '=', 'Ferrero')->first();

        $representanteCliente->cliente_id = $cliente->id;
        $representanteCliente->nombre = 'Jose Perez Leon';
        $representanteCliente->status = 'ACTIVO';
        $representanteCliente->contacts = json_encode(['cel' => '345460923', 'email' => 'some@domain.com']);
        $representanteCliente->calle = '';
        $representanteCliente->num_ext = '';
        $representanteCliente->num_int = '';
        $representanteCliente->cp = '';
        $representanteCliente->estados_replubica_catalogs_id = null;
        $representanteCliente->municipio = '';

        $representanteCliente->save();
    }
}
