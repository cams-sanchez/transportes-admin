<?php

use Illuminate\Database\Seeder;
use App\Models\Company;

class CompanyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $company = new Company();

        $company->nombre = 'PysisTI';
        $company->razon_social = 'PysisTI';
        $company->rfc = 'GAFR7709277J2';
        $company->tipo_fiscal = 'fisica';
        $company->status = 'ACTIVE';
        $company->contacts = '{casa: 5557898989, cel:5512345678, email:info@pysisti.com}';
        $company->calle= 'Alfonso Herrera';
        $company->num_ext = '4567';
        $company->num_int;
        $company->cp = '98789';
        $company->estados_replubica_catalogs_id;
        $company->municipio = 'Zapopan';
        $company->fiscal_calle = 'Norte 92';
        $company->fiscal_num_ext = '3454';
        $company->fiscal_num_int;
        $company->fiscal_cp = '343454';
        $company->fiscal_estado = '';
        $company->fiscal_municipio = 'Gustavo A Madero';

        $company->save();

    }
}