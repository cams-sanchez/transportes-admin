<?php

use Illuminate\Database\Seeder;
use App\Models\TipoUsuarios;

class TiposDeUsuarioTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tiposDeUsuario = [
            [
                'nombre' => 'Admin',
                'descripcion' => 'El usuario es Administrador',
                'status' => 'ACTIVO'
            ],
            [
                'nombre' => 'Operador',
                'descripcion' => 'El usuario es Operador',
                'status' => 'ACTIVO'
            ],
            [
                'nombre' => 'Capturista',
                'descripcion' => 'El usuario es Capturista',
                'status' => 'ACTIVO'
            ],
            [
                'nombre' => 'Cliente',
                'descripcion' => 'El usuario es Cliente',
                'status' => 'ACTIVO'
            ],
            [
                'nombre' => 'Transportista',
                'descripcion' => 'El usuario es Transportista',
                'status' => 'ACTIVO'
            ],
            [
                'nombre' => 'Portal Consulta',
                'descripcion' => 'El usuario solo puede ver el portal de tiros',
                'status' => 'ACTIVO'
            ],
        ];

        foreach ($tiposDeUsuario as $usuario) {

            $usuarioObj = new TipoUsuarios();

            $usuarioObj->nombre = $usuario['nombre'];
            $usuarioObj->descripcion = $usuario['descripcion'];
            $usuarioObj->status = $usuario['status'];

            $usuarioObj->save();
        }
    }
}
