<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('index');
})->name('index');

Route::post('register', [UserController::class, 'store']) -> name('users.store');

Route::get('register', function() {
    return view('register');
})->name('register');


//[LoginController::class, 'store' ]
//function() {dd('hello');}