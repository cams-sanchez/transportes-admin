<?php

use Illuminate\Database\Seeder;
use App\Models\Transportista;
use App\Models\User;
use App\Models\Company;
use App\Models\EstadosReplubicaCatalog;
use App\Models\TipoUsuarios;


class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();

        $company = Company::where('nombre', '=', 'PysisTI')->first();
        $estadoRep = EstadosReplubicaCatalog::where('estado', '=', 'Jalisco')->first();
        $tipoUsuario = TipoUsuarios::where('nombre', '=', 'Admin')->first();
        $tranportista = Transportista::where('nombre', '=', 'Transportes Cams-Sanchez')->first();

        $user->company_id = $company->id;
        $user->transportista_id = $tranportista->id;
        $user->tipo_usuarios_id = $tipoUsuario->id;
        $user->name = 'Rafael Galvan';
        $user->email = 'rafa@email.com';
        $user->email_verified_at = null;
        $user->password = bcrypt('1234');;
        $user->status = 'ACTIVO';
        $user->contacts = json_encode(['casa'=> '5557898989', 'cel'=>'5512345678', 'email'=>'info@pysisti.com']);
        $user->user_nick = 'rufus';
        $user->calle = 'calle 2';
        $user->num_ext = '234';
        $user->num_int = 'B';
        $user->cp = '09876';
        $user->estados_replubica_catalogs_id = $estadoRep->id;
        $user->municipio = '';

        $user->save();
    }
}
