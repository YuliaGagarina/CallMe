<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\User;

class AuthController extends Controller
{
/**
* Create a new AuthController instance.
*
* @return void
*/
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'registration']]);
        $this->middleware('jwt.refresh')->only('refresh');;
    }

/**
* Get a JWT via given credentials.
*
* @return \Illuminate\Http\JsonResponse
*/
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], Response::HTTP_NOT_FOUND);
        }

        return $this->respondWithToken($token);
    }

/**
* User registration
*/
    public function registration()
    {
        $name = request('name');
        $email = request('email');
        $password = request('password');
        if (!isset($name, $email, $password)) {
            return response()->json(['message' => 'Invalid data, please, check your data'], 422);
        } else {
            $user = new User();
            $user->name = $name;
            $user->email = $email;
            $user->password = Hash::make($password);
            $user->save();
            return response()->json(['message' => 'Successfully registration!'], Response::HTTP_CREATED, [
                'Location' => $user
            ]);
        }

    }

/**
* Get the authenticated User.
*
* @return \Illuminate\Http\JsonResponse
*/
    public function me()
    {
        return response()->json(auth()->user());
    }

/**
* Log the user out (Invalidate the token).
*
* @return \Illuminate\Http\JsonResponse
*/

/**
* Refresh a token.
*
* @return \Illuminate\Http\JsonResponse
*/
    public function refresh()
    {
        $token = (string)JWTAuth::getToken();

        $token = JWTAuth::setToken($token)->invalidate();

        $newToken = JWTAuth::refresh($token);

        return response()->respondWithToken(['message' => $newToken]);

    }

    /**
     * Get the token array structure.
     *
     * @param string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
