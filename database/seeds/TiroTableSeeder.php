<?php

use App\Constants\StatusConstants;
use App\Models\EstablecimientosCatalog;
use App\Models\EstadosReplubicaCatalog;
use App\Models\JefeDeSector;
use App\Models\TiposDeCargaCatalog;
use App\Models\Tiro;
use App\Models\Unidad;
use App\Models\Viaje;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class TiroTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $establecimiento1 = EstablecimientosCatalog::where('nombre', '=', 'Farmacia Avila Camacho')->first();
        $establecimiento2 = EstablecimientosCatalog::where('nombre', '=', 'Tienda Avila Camacho')->first();
        $viaje = Viaje::where('nombre', '=', 'Viaje Zapopan Jalisco')->first();
        $unidad = Unidad::where('nombre', '=', 'Unidad Torton')->first();
        $unidad2 = Unidad::where('nombre', '=', 'Unidad Tornado')->first();
        $tipoDeCarga = TiposDeCargaCatalog::where('nombre', '=', 'Exhibidor')->first();
        $tipoDeCarga2 = TiposDeCargaCatalog::where('nombre', '=', 'Cafetera')->first();
        $jefeSector = JefeDeSector::where('nombre', '=', 'Juan Ramon Saenz')->first();
        $estadoRep = EstadosReplubicaCatalog::where('estado', '=', 'Monterrey')->first();

        $tirosViaje = [
            [
                'viaje_id' => $viaje->id,
                'ciudad' => 'Monterrey',
                'unidad_id' => $unidad->id,
                'establecimiento_id' => $establecimiento1->id,
                'tipo_carga_id' => $tipoDeCarga->id,
                'cantidad' => 200,
                'delivery' => '565614545',
                'epv' => '1245454',
                'jefe_de_sector_id' => $jefeSector->id,
                'sdic' => '67865',
                'doc' => '56787654',
                'region' => 'NL',
                'fecha_entrega_solicitada' => Carbon::now(),
                'propuesta_361' => Carbon::now(),
                'notas' => '',
                'status' => StatusConstants::ACTIVE_STATUS,
            ],
            [
                'viaje_id' => $viaje->id,
                'ciudad' => 'Monterrey',
                'unidad_id' => $unidad2->id,
                'establecimiento_id' => $establecimiento2->id,
                'tipo_carga_id' => $tipoDeCarga2->id,
                'cantidad' => 200,
                'delivery' => 'ABCD10978',
                'epv'=> '123124',
                'jefe_de_sector_id' => $jefeSector->id,
                'sdic' => '324234',
                'doc' => '34234234',
                'region' => 'NL',
                'fecha_entrega_solicitada' => Carbon::now(),
                'propuesta_361' => Carbon::now(),
                'notas' => '',
                'status' => StatusConstants::ACTIVE_STATUS,
            ],
        ];


        foreach ($tirosViaje as $tiro) {

            $tiroObj = new Tiro();

            $tiroObj->viaje_id = $tiro['viaje_id'];
            $tiroObj->ciudad = $tiro['ciudad'];
            $tiroObj->unidad_id = $tiro['unidad_id'];
            $tiroObj->establecimiento_id = $tiro['establecimiento_id'];
            $tiroObj->tipo_carga_id = $tiro['tipo_carga_id'];
            $tiroObj->cantidad = $tiro['cantidad'];
            $tiroObj->delivery = $tiro['delivery'];
            $tiroObj->epv = $tiro['epv'];
            $tiroObj->jefe_de_sector_id = $tiro['jefe_de_sector_id'];
            $tiroObj->sdic = $tiro['sdic'];
            $tiroObj->doc = $tiro['doc'];
            $tiroObj->region = $tiro['region'];
            $tiroObj->fecha_entrega_solicitada = $tiro['fecha_entrega_solicitada'];
            $tiroObj->propuesta_361 = $tiro['propuesta_361'];
            $tiroObj->notas = $tiro['notas'];
            $tiroObj->status = $tiro['status'];

            //$tiroObj->save();

        }
    }
}
