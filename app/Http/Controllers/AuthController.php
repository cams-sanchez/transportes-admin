<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $rules = [
            'email' => 'required|exists:users',
            'password'  => 'required'
        ];
        $request->validate($rules);
        $data = [
            'email' => $request->get('email'),
            'password'  =>  $request->get('password'),
            'status' => 'ACTIVO'
        ];
        if(Auth::attempt($data))
        {
            $user = Auth::user();

            $tokenResult = $user->createToken(config('APP_NAME'));
            $tokenResult->token->expires_at = Carbon::now()->addMinute(180);
            $tokenResult->token->save();

            return response()->json([
                'user'  =>  $user,
                'token_type' => 'Bearer',
                'token' =>  $tokenResult->accessToken
            ]);
        }
        else
        {
            return response()->json('Unauthorized', 401);
        }
    }
}
