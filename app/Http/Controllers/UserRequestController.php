<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserRequestResource;
use App\Models\UserRequest;
use Illuminate\Support\Facades\Auth;

class UserRequestController extends Controller
{
    public function create()
    {
        $request = request('request');

        $user = Auth::user();
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
