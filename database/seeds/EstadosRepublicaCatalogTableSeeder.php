<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\EstadosReplubicaCatalog;

class EstadosRepublicaCatalogTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $estadosPorRegion = [
            'NorOeste' => [
                'Baja California Norte',
                'Baja California Sur',
                'Chihuahua',
                'Durango',
                'Sinaloa',
                'Sonora',
            ],
            'NorEste' => [
                'Coahuila',
                'Nuevo León',
                'Tamaulipas',
            ],
            'Oeste' => [
                'Colima',
                'Jalisco',
                'Michoacán',
                'Nayarit',
            ],
            'Este' => [
                'Hidalgo',
                'Puebla',
                'Tlaxcala',
                'Veracruz',
            ],
            'CentroNorte' => [
                'Aguascalientes',
                'Guanajuato',
                'Querétaro',
                'San Luis Potosí',
                'Zacatecas',
            ],
            'CentroSur' => [
                'Ciudad De México',
                'Estado de México',
                'Morelos',
            ],
            'SurOeste' => [
                'Chiapas',
                'Guerrero',
                'Oaxaca',
            ],
            'SurEste' => [
                'Campeche',
                'Quintana Roo',
                'Tabasco',
                'Yucatán'
            ]
        ];


        foreach ($estadosPorRegion as $region=>$estados) {

            foreach ($estados as $estado) {
                /*DB::table('estados_replubica_catalogs')->insert([
                    'id' => \Ramsey\Uuid\Uuid::uuid4(),
                    'region' => $region,
                    'estado' => $estado
                ]);*/

                $estadoRep = new EstadosReplubicaCatalog();
                $estadoRep->region = $region;
                $estadoRep->estado = $estado;
                $estadoRep->save();

            }
        }

    }
}
