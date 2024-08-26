<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegistrationRequest;
use App\Models\User;
use App\Services\AuthService;

class AuthController extends Controller
{
    public function login(LoginRequest $loginRequest)
    {
        $credentials = $loginRequest->validated();

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }


    public function registration(RegistrationRequest $registrationRequest, AuthService $authService)
    {
        $data = $registrationRequest->validated();
        $authService->register($data);

        return response('ok');
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
