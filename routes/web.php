<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdController;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;


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

Route::get('/dashboard', [UserController::class, 'index']) ->name('dashboard'); 
Route::get('/create', [AdController::class, 'create'])->name('ads.create');
Route::post('/create', [AdController::class, 'store'])->name('ads.store'); 

Route::get('/forgot-password', function () {
return view('forgot-password');
})->name('password.request');

Route::get('/ads/{ad}', [AdController::class, 'show'])->name('ads.show');

Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);
 
    $status = Password::sendResetLink(
        $request->only('email')
    );
 
    return $status === Password::RESET_LINK_SENT
                ? back()->with(['status' => __($status)])
                : back()->withErrors(['email' => __($status)]);
})->name('password.email');

Route::get('/reset-password/{token}', function (string $token) {
    return view('reset-password', ['token' => $token]);
})->name('password.reset');


Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);
 
    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function (User $user, string $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));
 
            $user->save();
 
            event(new PasswordReset($user));
        }
    );
 
    return $status === Password::PASSWORD_RESET
                ? redirect()->route('users.login')->with('status', __($status))
                : back()->withErrors(['email' => [__($status)]]);
})->name('password.update');