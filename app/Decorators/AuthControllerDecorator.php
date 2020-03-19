<?php


namespace App\Decorators;

use App\Models\User;
use Laravel\Passport\PersonalAccessTokenResult;

/**
 * Class AuthControllerDecorator
 * @package App\Decorators
 */
class AuthControllerDecorator
{
    /** @var array $equipoCelular */
    protected $equipoCelular = [];

    /**
     * @param User $user
     * @param PersonalAccessTokenResult $tokenResult
     * @return array
     */
    public function decorateLoginUserResponse(User $user, PersonalAccessTokenResult $tokenResult)
    {
        $this->createCellPhonesArray($user->equipoCelular);

        return ['success' => true,
            'foundUserInfo' => [
                'name' => $user->name,
                'email' => $user->email,
                'user_nick' => $user->user_nick,
                'status' => $user->status,
                'contacts' => json_decode($user->contacts),
                'permissions' => [],
                'phoneGear' => $this->equipoCelular,
                'tipo_usuario' => $user->tipoUsuario,
                'company' => $user->company->nombre,
                'transportista' => $user->transportista->nombre,
                'direccion' => [
                    'calle' => $user->calle,
                    'num_ext' => $user->num_ext,
                    'num_int' => $user->num_int,
                    'cp' => $user->cp,
                    'estado' => $user->estado,
                    'municipio' => $user->municipio,
                ],
            ],
            'token_type' => 'Bearer',
            'token' => $tokenResult->accessToken];
    }

    public function decorateGetUserInfo(User $user)
    {
        $this->createCellPhonesArray($user->equipoCelular);

        return [
            'success' => true,
            'foundUserInfo' => [
                'name' => $user->name,
                'email' => $user->email,
                'user_nick' => $user->user_nick,
                'status' => $user->status,
                'contacts' => json_decode($user->contacts),
                'permissions' => [],
                'phoneGear' => $this->equipoCelular,
                'tipo_usuario' => $user->tipoUsuario,
                'company' => $user->company->nombre,
                'transportista' => $user->transportista->nombre,
                'direccion' => [
                    'calle' => $user->calle,
                    'num_ext' => $user->num_ext,
                    'num_int' => $user->num_int,
                    'cp' => $user->cp,
                    'estado' => $user->estado,
                    'municipio' => $user->municipio,
                ],
            ]
        ];
    }

    protected function createCellPhonesArray(Object $cellPhones)
    {
        foreach ($cellPhones as $celular) {
            $this->equipoCelular[] =
                [
                    'marca' => $celular->marca,
                    'modelo' => $celular->model,
                    'numero' => $celular->numero,
                    'company' => $celular->company,
                ];
        }
    }
}
