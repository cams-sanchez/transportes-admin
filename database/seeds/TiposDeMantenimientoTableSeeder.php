<?php

use App\Models\TiposDeMantenimientoCatalog;
use App\Models\Unidad;
use Illuminate\Database\Seeder;

class TiposDeMantenimientoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tiposDeMantenimiento = [
            [
                'nombre' => 'Mantenimiento 10,000 kms',
                'descripcion' => 'Manteminiento que se debe realizar cada 10 mil Kilometros',
                'cambios_a_realizar' => 'Se realizara el cambio aceite, liquido de frenos y llenar agua limpiadores',
                'realizarse_al_kilometraje' => '10000',
                'status' => 'ACTIVO'
            ],
            [
                'nombre' => 'Mantenimiento 100,000 kms',
                'descripcion' => 'Manteminiento que se debe realizar cada 100 mil Kilometros',
                'cambios_a_realizar' => 'Se realizara el cambio aceite, cambio de liquido de frenos, rectificacion
                de discos, cambio de balatas',
                'realizarse_al_kilometraje' => '100000',
                'status' => 'ACTIVO'
            ]
        ];

        foreach ($tiposDeMantenimiento as $tipoMntenimiento) {

            $tipoDeMantenimiento = new TiposDeMantenimientoCatalog();

            $tipoDeMantenimiento->nombre = $tipoMntenimiento['nombre'];
            $tipoDeMantenimiento->descripcion = $tipoMntenimiento['descripcion'];
            $tipoDeMantenimiento->cambios_a_realizar = $tipoMntenimiento['cambios_a_realizar'];
            $tipoDeMantenimiento->realizarse_al_kilometraje = $tipoMntenimiento['realizarse_al_kilometraje'];
            $tipoDeMantenimiento->status = $tipoMntenimiento['status'];

            $tipoDeMantenimiento->save();
        }
    }
}
