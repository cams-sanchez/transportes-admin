<?php

use App\Models\Temporada;
use App\Models\Tren;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class TrenTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tren = new Tren();
        $tren2 = new Tren();

        $temporada = Temporada::where('nombre', '=', 'Dia De Las Madres')->first();

        $tren->temporada_id = $temporada->id;
        $tren->nombre='Tren Zona Oeste Jalisco';
        $tren->zona = 'Oeste';
        $tren->descripcion = '';
        $tren->fecha_comienzo = Carbon::now();
        $tren->fecha_fin = null;
        $tren->status = 'ACTIVO';
        $tren->save();

        $tren2->temporada_id = $temporada->id;
        $tren2->nombre='Tren Guerrero';
        $tren2->zona = 'SurOeste';
        $tren2->descripcion = '';
        $tren2->fecha_comienzo = Carbon::now();
        $tren2->fecha_fin = null;
        $tren2->status = 'ACTIVO';
        $tren2->save();
    }
}
