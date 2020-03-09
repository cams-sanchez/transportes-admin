<?php

use App\Models\EquipoCelular;
use App\Models\User;
use Illuminate\Database\Seeder;

class EquipoCelularTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $equipoCelular = new EquipoCelular();

        $operador = User::where('name', '=', 'Rafael Galvan')->first();

        $equipoCelular->usuario_id = $operador->id;
        $equipoCelular->marca = 'Samsung';
        $equipoCelular->modelo = 'A50';
        $equipoCelular->numero = '5523124565';
        $equipoCelular->company = 'ATT';
        $equipoCelular->url_factura = '';
        $equipoCelular->url_contrato = '';
        $equipoCelular->status = 'ACTIVO';
    }
}
