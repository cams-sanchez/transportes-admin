<?php

use App\Models\RepresentanteCliente;
use App\Models\Temporada;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class TemporadaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $temporada = new Temporada();

        $representateCliente = RepresentanteCliente::where('nombre', '=', 'Jose Perez Leon')->first();
        $fecha = Carbon::now();

        $temporada->autorizado_por = $representateCliente->id;
        $temporada->nombre = 'Dia De Las Madres';
        $temporada->descripcion = 'Entrega de exhibidores para el dia de las madres';
        $temporada->fecha_inicio_estipulada = $fecha->add(1, 'day');
        $temporada->fecha_inicio_real = $fecha->add(10, 'day');
        $temporada->fecha_fin_estipulada = $fecha->add(30, 'day');
        $temporada->fecha_fin_real = null;
        $temporada->status = 'ACTIVO';

        $temporada->save();

        $temporada2 = new Temporada();

        $representateCliente = RepresentanteCliente::where('nombre', '=', 'Jose Perez Leon')->first();
        $fecha = Carbon::now();

        $temporada2->autorizado_por = $representateCliente->id;
        $temporada2->nombre = 'Temporada Generica';
        $temporada2->descripcion = 'Para usar de manera General en todos los tiros y viajes';
        $temporada2->fecha_inicio_estipulada = $fecha->add(1, 'day');
        $temporada2->fecha_inicio_real = $fecha->add(10, 'day');
        $temporada2->fecha_fin_estipulada = $fecha->add(30, 'day');
        $temporada2->fecha_fin_real = null;
        $temporada2->status = 'ACTIVO';

        $temporada2->save();
    }
}
