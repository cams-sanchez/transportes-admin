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
        $establecimiento2 = new EstablecimientosCatalog();

        $tipoEstablecimiento = TiposDeEstablecimiento::where('nombre', '=', 'Farmacia Guadalajara')->first();
        $tipoEstablecimiento2 = TiposDeEstablecimiento::where('nombre', '=', 'Walmart')->first();
        $estadoRep = EstadosReplubicaCatalog::where('estado', '=', 'Jalisco')->first();

        $establecimiento->tipo_id = $tipoEstablecimiento->id;
        $establecimiento->nombre = 'Farmacia Avila Camacho';
        $establecimiento->calle = 'Av Avila Camacho';
        $establecimiento->num_ext = '150';
        $establecimiento->num_int = 'A';
        $establecimiento->cp = '98789';
        $establecimiento->estados_replubica_catalogs_id = $estadoRep->id;
        $establecimiento->municipio = '';
        $establecimiento->gps_location_lat = 0.00;
        $establecimiento->gps_location_long = 0.00;
        $establecimiento->encargado_recibir = 'Some Dude';
        $establecimiento->contacto = json_encode(['oficina' => '4455667788', 'email' => 'some@domain.com']);
        $establecimiento->status = 'ACTIVO';

        $establecimiento->save();

        $establecimiento2->tipo_id = $tipoEstablecimiento2->id;
        $establecimiento2->nombre = 'Tienda Avila Camacho';
        $establecimiento2->calle = 'Av Avila Camacho';
        $establecimiento2->num_ext = '150';
        $establecimiento2->num_int = 'B';
        $establecimiento2->cp = '98789';
        $establecimiento2->estados_replubica_catalogs_id = $estadoRep->id;
        $establecimiento2->municipio = '';
        $establecimiento2->gps_location_lat = 0.00;
        $establecimiento2->gps_location_long = 0.00;
        $establecimiento2->encargado_recibir = 'Some Dude';
        $establecimiento2->contacto = json_encode(['oficina' => '4455667788', 'email' => 'some@domain.com']);
        $establecimiento2->status = 'ACTIVO';

        $establecimiento2->save();
    }
}
