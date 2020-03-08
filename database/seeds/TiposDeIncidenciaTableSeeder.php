<?php

use App\Models\TiposDeCargaCatalog;
use App\Models\TiposDeIncidenciaCatalog;
use Illuminate\Database\Seeder;

class TiposDeIncidenciaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tiposDeIncidencias = [
            [
                'nombre'=>'Local No Encontrado',
                'descripcion'=>'La direccion del local no es correcto, o ya no existe',
                'como_resolver'=>'Contactar al representante del Cliente para que se de corrobore la informacion',
                'status'=>'ACTIVO'
            ],
            [
                'nombre'=>'No Hay Quien Reciba',
                'descripcion'=>'El encargado de recibir no se encuentra',
                'como_resolver'=>'Contactar al representante del Cliente',
                'status'=>'ACTIVO'
            ],
            [
                'nombre'=>'No Hay Quien Entregue',
                'descripcion'=>'El encargado de entregar no se encuentra',
                'como_resolver'=>'Contactar al representante del Cliente',
                'status'=>'ACTIVO'
            ],
            [
                'nombre'=>'Falla Mecanica',
                'descripcion'=>'La unidad tuvo algun tipo de falla mecanica',
                'como_resolver'=>'Contactar al representante del Cliente',
                'status'=>'ACTIVO'
            ],
            [
                'nombre'=>'Perdida Por Asalto',
                'descripcion'=>'La unidad fue robada',
                'como_resolver'=>'Contactar al representante del Cliente',
                'status'=>'ACTIVO'
            ],
        ];

        foreach ($tiposDeIncidencias as $tiposDeIncidencia) {
            $tiposDeIncidenciaObj = new TiposDeIncidenciaCatalog();

            $tiposDeIncidenciaObj->nombre = $tiposDeIncidencia['nombre'];
            $tiposDeIncidenciaObj->descripcion = $tiposDeIncidencia['descripcion'];
            $tiposDeIncidenciaObj->como_resolver = $tiposDeIncidencia['como_resolver'];
            $tiposDeIncidenciaObj->status = $tiposDeIncidencia['status'];

            $tiposDeIncidenciaObj->save();
        }
    }
}
