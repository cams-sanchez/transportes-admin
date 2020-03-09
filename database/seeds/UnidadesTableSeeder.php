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
        $unidad2 = new Unidad();

        $unidad->nombre = 'Unidad Torton';
        $unidad->tipo = 'Torton';
        $unidad->marca = 'Ford';
        $unidad->tonelaje = '50';
        $unidad->kilometraje = '100';
        $unidad->otros_detalles = 'Se usa para cargas grandes';
        $unidad->url_factura = '';
        $unidad->status = 'DISPONIBLE';

        $unidad->save();

        $unidad2->nombre = 'Unidad Tornado';
        $unidad2->tipo = 'Tornado';
        $unidad2->marca = 'Ford';
        $unidad2->tonelaje = '1';
        $unidad2->kilometraje = '105000';
        $unidad2->otros_detalles = 'Se usa para cargas pequeñas';
        $unidad2->url_factura = '';
        $unidad2->status = 'DISPONIBLE';

        $unidad2->save();
    }
}
