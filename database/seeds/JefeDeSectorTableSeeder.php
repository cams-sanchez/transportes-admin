<?php

use App\Models\JefeDeSector;
use Illuminate\Database\Seeder;

class JefeDeSectorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jefeDeSector = new JefeDeSector();

        $jefeDeSector->nombre='Juan Ramon Saenz';
        $jefeDeSector->email='dude@domain.com';
        $jefeDeSector->contactos_telefonicos=json_encode(['telefono'=>'8899778899', 'cel'=>'3456342312']);
        $jefeDeSector->direccion='Av San Jorge #34, Col. San Simon, cp 98789, Zapopan, Jalisco';
        $jefeDeSector->status='ACTIVO';

        $jefeDeSector->save();
    }
}
