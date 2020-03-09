<?php

use App\Models\TiposDeEstablecimiento;
use Illuminate\Database\Seeder;

class TiposDeEstablecimientoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tiposDeEstablecimientos = [
            [
                'nombre'=>'Farmacia Guadalajara',
                'descripcion'=>'Farmacias que pertenecen a la cadena de Guadalajara',
                'status'=>'ACTIVO',
            ],
            [
                'nombre'=>'Farmacia Similares',
                'descripcion'=>'Farmacias que pertenecen a la cadena Don Simi',
                'status'=>'ACTIVO',
            ],
            [
                'nombre'=>'Walmart',
                'descripcion'=>'Tienda Walmart',
                'status'=>'ACTIVO',
            ],
            [
                'nombre'=>'Superama',
                'descripcion'=>'Tienda Superama',
                'status'=>'ACTIVO',
            ],
            [
                'nombre'=>'Aurrera',
                'descripcion'=>'Tienda Aurrera',
                'status'=>'ACTIVO',
            ]
        ];

        foreach ($tiposDeEstablecimientos as $tipoEstablecimiento) {

            $tipoEstablecimientoObj= new TiposDeEstablecimiento();

            $tipoEstablecimientoObj->nombre = $tipoEstablecimiento['nombre'];
            $tipoEstablecimientoObj->descripcion = $tipoEstablecimiento['descripcion'];
            $tipoEstablecimientoObj->status = $tipoEstablecimiento['status'];

            $tipoEstablecimientoObj->save();
        }
    }
}
