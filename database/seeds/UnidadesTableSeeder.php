<?php

use App\Models\Unidad;
use Illuminate\Database\Seeder;

class UnidadesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $unidad = new Unidad();

        $unidad->nombre = 'Unidad Torton';
        $unidad->tipo = 'Torton';
        $unidad->marca = 'Ford';
        $unidad->tonelaje = '50';
        $unidad->kilometraje = '100';
        $unidad->otros_detalles = 'Se usa para cargas grandes';
        $unidad->url_factura = '';
        $unidad->status = 'ACTIVO';

        $unidad->save();
    }
}
