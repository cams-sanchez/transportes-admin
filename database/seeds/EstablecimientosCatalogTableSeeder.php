<?php

use App\Models\EstablecimientosCatalog;
use App\Models\EstadosReplubicaCatalog;
use App\Models\TiposDeEstablecimiento;
use Illuminate\Database\Seeder;

class EstablecimientosCatalogTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $establecimiento = new EstablecimientosCatalog();

        $tipoEstablecimiento = TiposDeEstablecimiento::where('nombre', '=', 'Farmacia Guadalajara')->first();
        $estadoRepFiscal = EstadosReplubicaCatalog::where('estado', '=', 'Jalisco')->first();

        $establecimiento->tipo_id = $tipoEstablecimiento->id;
        $establecimiento->nombre = 'Avila Camacho';
        $establecimiento->calle = 'Av Avila Camacho';
        $establecimiento->num_ext = '150';
        $establecimiento->num_int = 'A';
        $establecimiento->cp = '98789';
        $establecimiento->estados_replubica_catalogs_id = $estadoRepFiscal->id;
        $establecimiento->municipio = '';
        $establecimiento->gps_location_lat = 0.00;
        $establecimiento->gps_location_long = 0.00;
        $establecimiento->encargado_recibir = 'Some Dude';
        $establecimiento->contacto = json_encode(['oficina' => '4455667788', 'email' => 'some@domain.com']);
        $establecimiento->status = 'ACTIVO';
    }
}
