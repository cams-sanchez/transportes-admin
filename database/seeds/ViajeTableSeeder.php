<?php

use App\Models\EstadosReplubicaCatalog;
use App\Models\JefeDeSector;
use App\Models\Tren;
use App\Models\Viaje;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ViajeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $viaje = new Viaje();
        $tren = Tren::where('nombre', '=', 'Tren Zona Oeste Jalisco')->first();
        $estadoRep = EstadosReplubicaCatalog::where('estado', '=', 'Jalisco')->first();
        $fecha = Carbon::now();

        $viaje->tren_id = $tren->id;
        $viaje->estados_replubica_catalogs_id = $estadoRep->id;
        $viaje->nombre = 'Viaje Zapopan Jalisco';
        $viaje->fecha_comienzo = $fecha;
        $viaje->fecha_carga = $fecha;
        $viaje->fecha_salida_carga = null;
        $viaje->status = 'ACTIVO';

        $viaje->save();
    }
}
