<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\UserRequestController;
use Illuminate\Support\Facades\Route;

Route::get('', [UserController::class, 'login']);
Route::get('login', [UserController::class, 'login']);
Route::get('registration', [UserController::class, 'registration']);

Route::get('user-request', [UserRequestController::class, 'show'])->middleware('auth');
