<?php

namespace App\Http\Controllers;

use App\Decorators\AuthControllerDecorator;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class AuthController
 * @package App\Http\Controllers
 */
class AuthController extends Controller
{
    /** @var AuthControllerDecorator $authDecorator */
    protected $authDecorator;

    /**
     * AuthController constructor.
     * @param AuthControllerDecorator $authDecorator
     */
    public function __construct(AuthControllerDecorator $authDecorator)
    {
        $this->authDecorator = $authDecorator;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function loginUser(Request $request)
    {
        $rules = [
            'email' => 'required|exists:users',
            'password' => 'required'
        ];

        $request->validate($rules);

        $incommingData = [
            'email' => $request->get('email'),
            'password' => $request->get('password'),
            'status' => 'ACTIVO'
        ];

        if (Auth::attempt($incommingData)) {
            $user = Auth::user();

            $tokenResult = $user->createToken(config('APP_NAME'));
            $tokenResult->token->expires_at = Carbon::now()->addMinute(180);
            $tokenResult->token->save();

            return response()->json($this->authDecorator->decorateLoginUserResponse($user, $tokenResult));

        } else {
            return response()->json('Unauthorized', 401);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logoutUser(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json([
            'success' => true,
            'message' => __('auth.logout_success')
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUserInfo(Request $request)
    {
        $tokenUserInfo = $request->user();

        $user = User::where('id', '=', $tokenUserInfo->id)->first();

        return response()->json($this->authDecorator->decorateGetUserInfo($user));
    }
}
