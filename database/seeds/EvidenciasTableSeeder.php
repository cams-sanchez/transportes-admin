<?php

use App\Constants\StatusConstants;
use App\Models\Evidencia;
use App\Models\Tiro;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class EvidenciasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tiros = Tiro::where('ciudad', '=', 'Monterrey')->get();


        foreach ($tiros as $tiro){


            $delivery = new Evidencia();

            $delivery->tiro_id = $tiro->id;
            $delivery->fecha_evidencia = Carbon::now();
            $delivery->foto_url = '';
            $delivery->tipo = 'delivery';
            $delivery->original_image_path = '';
            $delivery->comentarios = '';
            $delivery->gps_location_lat = 0.0;
            $delivery->gps_location_long = 0.0;
            $delivery->status = StatusConstants::AWAITING_STATUS;

            $delivery->save();

            $establecimiento = new Evidencia();

            $establecimiento->tiro_id = $tiro->id;
            $establecimiento->fecha_evidencia = Carbon::now();
            $establecimiento->foto_url = '';
            $establecimiento->tipo = 'establecimiento';
            $establecimiento->original_image_path = '';
            $establecimiento->comentarios = '';
            $establecimiento->gps_location_lat = 0.0;
            $establecimiento->gps_location_long = 0.0;
            $establecimiento->status = StatusConstants::AWAITING_STATUS;

            $establecimiento->save();

        }

    }
}
