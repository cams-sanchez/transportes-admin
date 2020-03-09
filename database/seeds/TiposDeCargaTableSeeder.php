<?php

use App\Models\TiposDeCargaCatalog;
use Illuminate\Database\Seeder;

class TiposDeCargaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tiposDeCarga = [
            [
                'nombre' => 'Caja',
                'unidadMetrica' => 'pieza',
                'descripcion' => 'Carga de Cajas de contenido varios',
                'status' => 'ACTIVO'
            ],
            [
                'nombre' => 'Lote',
                'unidadMetrica' => 'tonelada',
                'descripcion' => 'Carga de lote de cajas de contenido varios',
                'status' => 'ACTIVO'
            ],
            [
                'nombre' => 'Cafetera',
                'unidadMetrica' => 'pieza',
                'descripcion' => 'Carga de cafetera nestle',
                'status' => 'ACTIVO'
            ],
            [
                'nombre' => 'Exhibidor',
                'unidadMetrica' => 'pieza',
                'descripcion' => 'Carga de exhibidores Nestle',
                'status' => 'ACTIVO'
            ]
        ];

        foreach ($tiposDeCarga as $carga) {
            $cargaObj = new TiposDeCargaCatalog();

            $cargaObj->nombre = $carga['nombre'];
            $cargaObj->unidadMetrica = $carga['unidadMetrica'];
            $cargaObj->descripcion = $carga['descripcion'];
            $cargaObj->status = $carga['status'];

            $cargaObj->save();
        }
    }
}
