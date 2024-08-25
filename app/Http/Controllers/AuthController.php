<?php

namespace App\Http\Controllers;

use App\Models\User;
use AuthService;

class AuthController extends Controller
{
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }


    public function registration(AuthService $authService)
    {
        $name = request('name');
        $email = request('email');
        $password = request('password');

        $authService->register();

        return redirect('login');
    }




    public function me()
    {
        return response()->json(auth()->user());
    }


    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }


    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }


    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory(User::class)->getTTL() * 60
        ]);
    }
}
