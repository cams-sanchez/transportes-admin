<?php

use App\Models\TiposDeGastoCatalog;
use Illuminate\Database\Seeder;

class TiposDeGastoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tiposDeGastos = [
            [
                'nombre' => 'Gasolina En Proveedor',
                'descripcion' => 'Carga de gasolina en el proveedor habitual',
                'status' => 'ACTIVO'
            ],
            [
                'nombre' => 'Gasolina',
                'descripcion' => 'Carga de gasolina fuera del proveedor habitual',
                'status' => 'ACTIVO'
            ],
            [
                'nombre' => 'Caseta Efe',
                'descripcion' => 'Pago de caseta efectivo',
                'status' => 'ACTIVO'
            ],
            [
                'nombre' => 'Caseta Tag',
                'descripcion' => 'Pago de caseta con tag',
                'status' => 'ACTIVO'
            ],
            [
                'nombre' => 'Viatico Alimentacion',
                'descripcion' => 'Pago de viaticos de alimentacion',
                'status' => 'ACTIVO'
            ],
            [
                'nombre' => 'Viatico Hospedaje',
                'descripcion' => 'Pago de viaticos de hospedaje',
                'status' => 'ACTIVO'
            ],
            [
                'nombre' => 'Refaccion Por Mantenimiento',
                'descripcion' => 'Pago de refacciones por mantenimiento programado',
                'status' => 'ACTIVO'
            ],
            [
                'nombre' => 'Rafaccion en Ruta',
                'descripcion' => 'Pago refacciones por incidencias de Ruta',
                'status' => 'ACTIVO'
            ],
            [
                'nombre' => 'Mantenimiento',
                'descripcion' => 'Pago del servicio de mantenimiento',
                'status' => 'ACTIVO'
            ],
            [
                'nombre' => 'Gasto generico',
                'descripcion' => 'Gasto generado no tipificado',
                'status' => 'ACTIVO'
            ]
        ];

        foreach ($tiposDeGastos as $tipoGasto) {
            $tipoGastoObj = new TiposDeGastoCatalog();

            $tipoGastoObj->nombre = $tipoGasto['nombre'];
            $tipoGastoObj->descripcion = $tipoGasto['descripcion'];
            $tipoGastoObj->status = $tipoGasto['status'];

            $tipoGastoObj->save();
        }
    }
}
