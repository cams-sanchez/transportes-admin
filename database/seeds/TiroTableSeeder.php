<?php

use App\Models\EstablecimientosCatalog;
use App\Models\TiposDeCargaCatalog;
use App\Models\Tiro;
use App\Models\Unidad;
use App\Models\Viaje;
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
        $establecimiento1 = EstablecimientosCatalog::where('nombre','=','Farmacia Avila Camacho')->first();
        $establecimiento2 = EstablecimientosCatalog::where('nombre','=','Tienda Avila Camacho')->first();
        $viaje= Viaje::where('nombre', '=','Viaje Zapopan Jalisco')->first();
        $unidad = Unidad::where('nombre','=','Unidad Torton')->first();
        $unidad2 = Unidad::where('nombre','=','Unidad Tornado')->first();
        $tipoDeCarga = TiposDeCargaCatalog::where('nombre','=','Exhibidor')->first();
        $tipoDeCarga2 = TiposDeCargaCatalog::where('nombre','=','Cafetera')->first();

        $tirosViaje = [
            [
                'viaje_id' => $viaje->id,
                'unidad_id' => $unidad->id,
                'establecimiento_id' => $establecimiento1->id,
                'tipo_carga_id' => $tipoDeCarga->id,
                'cantidad' => 80,
                'delivery' => 'ABCD10989',
                'solicitud' => '12324EDR',
                'numero_de_pedido' => '123POUI',
                'notas' => '',
                'status' => 'ACTIVA'
            ],
            [
                'viaje_id' => $viaje->id,
                'unidad_id' => $unidad2->id,
                'establecimiento_id' => $establecimiento2->id,
                'tipo_carga_id' => $tipoDeCarga2->id,
                'cantidad' => 200,
                'delivery' => 'ABCD10978',
                'solicitud' => '124524EDR',
                'numero_de_pedido' => '1456POUI',
                'notas' => '',
                'status' => 'PENDIENTE'
            ]
        ];

        foreach ($tirosViaje as $tiro) {

            $tiroObj = new Tiro();

            $tiroObj->viaje_id=$tiro['viaje_id'];
            $tiroObj->unidad_id=$tiro['unidad_id'];
            $tiroObj->establecimiento_id=$tiro['establecimiento_id'];
            $tiroObj->tipo_carga_id=$tiro['tipo_carga_id'];
            $tiroObj->cantidad=$tiro['cantidad'];
            $tiroObj->delivery=$tiro['delivery'];
            $tiroObj->solicitud=$tiro['solicitud'];
            $tiroObj->numero_de_pedido=$tiro['numero_de_pedido'];
            $tiroObj->notas=$tiro['notas'];
            $tiroObj->status=$tiro['status'];

            $tiroObj->save();

        }
    }
}
