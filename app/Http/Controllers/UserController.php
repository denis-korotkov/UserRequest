<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function login()
    {
        return view('login');
    }


    public function registration()
    {
        return view('registration');
    }
}
