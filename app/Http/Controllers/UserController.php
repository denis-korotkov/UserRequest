<?php

namespace App\Http\Controllers;

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
