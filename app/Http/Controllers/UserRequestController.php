<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserRequestResource;
use App\Models\UserRequest;
use App\Services\AuthService;

class UserRequestController extends Controller
{
    public function create(AuthService $authService)
    {
        $request = request('request');

        $user = $authService->getCurrentUser();
        UserRequest::create([
            'request' => $request,
            'user_id' => $user->id
        ]);

        return response('created', 200);
    }


    public function show(): UserRequestResource
    {
        return new UserRequestResource(UserRequest::paginate());
    }
}
