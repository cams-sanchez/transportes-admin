<?php

use App\Models\EstadosReplubicaCatalog;
use Illuminate\Database\Seeder;
use App\Models\Transportista;

class TransportistaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $transportista = new Transportista();

        $estadoRepFiscal = $estadoRep = EstadosReplubicaCatalog::where('estado', '=', 'Estado de México')->first();


        $transportista->nombre = 'Transportes Cams-Sanchez';
        $transportista->razon_social = 'Transportes Cams-Sanchez';
        $transportista->rfc = 'CAMS089809TY6';
        $transportista->tipo_fiscal = 'fisica';
        $transportista->status = 'ACTIVO';
        $transportista->contacts = json_encode(
            [
                'casa' => '5557898989',
                'cel' => '5512345678',
                'email' => 'transportes.cams.sanchez@gmail.com'
            ]);
        $transportista->calle = 'Domicilio Conocido';
        $transportista->num_ext = '45673';
        $transportista->num_int = '';
        $transportista->cp = '98789';
        $transportista->estados_replubica_catalogs_id = $estadoRep->id;
        $transportista->municipio = '';
        $transportista->fiscal_calle = '';
        $transportista->fiscal_num_ext = '';
        $transportista->fiscal_num_int = '';
        $transportista->fiscal_cp = '';
        $transportista->fiscal_estados_replubica_catalogs_id = $estadoRepFiscal->id;
        $transportista->fiscal_municipio = 'Lerma';

        $transportista->save();
    }
}
