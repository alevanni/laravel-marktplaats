<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdController;

Route::get('/', [AdController::class, 'index'])->name('index');

// REGISTER
Route::post('register', [UserController::class, 'store'])->name('users.store');

Route::get('register', function () {
    return view('register');
})->name('register');

//LOGIN
Route::get('login', function () {
    return view('login');
})->name('login');

Route::post('login', [LoginController::class, 'authenticate'])->name('users.login');
Route::get('logout', [LoginController::class, 'logOut'])->name('users.logout');
