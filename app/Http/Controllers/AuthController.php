<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginUser(Request $request)
    {
        $rules = [
            'email' => 'required|exists:users',
            'password' => 'required'
        ];
        $request->validate($rules);

        $data = [
            'email' => $request->get('email'),
            'password' => $request->get('password'),
            'status' => 'ACTIVO'
        ];

        if (Auth::attempt($data)) {
            $user = Auth::user();

            $tokenResult = $user->createToken(config('APP_NAME'));
            $tokenResult->token->expires_at = Carbon::now()->addMinute(180);
            $tokenResult->token->save();

            //TODO We may need to create a decorator or something else to get all this info to make this
            // method lighter BTW the phones are an array we need to iterate them
            $responseArray = [
                'success' => true,
                'foundUserInfo' => [
                    'name' => $user->name,
                    'email' => $user->email,
                    'user_nick' => $user->user_nick,
                    'status' => $user->status,
                    'contacts' => json_decode($user->contacts),
                    'permissions' => [],
                    'phoneGear' => $user->equipoCelular,
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
                'token' => $tokenResult->accessToken
            ];

            return response()->json($responseArray);
        } else {
            return response()->json('Unauthorized', 401);
        }
    }

    public function logoutUser(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json([
            'success' => true,
            'message' => __('auth.logout_success')
        ]);
    }

    public function getUserInfo(Request $request)
    {
        $tokenUserInfo = $request->user();

        $user = User::where('id', '=', $tokenUserInfo->id)->first();

        return response()->json(
            [
                'success' => true,
                'foundUserInfo' => [
                    'name' => $user->name,
                    'email' => $user->email,
                    'user_nick' => $user->user_nick,
                    'status' => $user->status,
                    'contacts' => json_decode($user->contacts),
                    'permissions' => [],
                    'phoneGear' => $user->equipoCelular,
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
            ]);
    }
}
