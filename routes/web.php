<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdController;
use App\Http\Controllers\BidController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MessageController;

Route::get('/', [AdController::class, 'index'])->name('index');

// REGISTERS A NEW USER
Route::get('register', [LoginController::class, 'create'])->name('register');
Route::post('register', [UserController::class, 'store'])->name('users.store');

// LOGIN
Route::get('login/{ad?}', [LoginController::class, 'index'])->name('login');
Route::post('login/{ad?}', [LoginController::class, 'authenticate'])->name('users.login');
Route::get('logout', [LoginController::class, 'logOut'])->name('users.logout');

// ADS
Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');
Route::get('/create', [AdController::class, 'create'])->name('ads.create');
Route::post('/create', [AdController::class, 'store'])->name('ads.store');

Route::get('/ads/{ad}', [AdController::class, 'show'])->name('ads.show');
Route::get('/ads/{ad}/edit', [AdController::class, 'edit'])->name('ads.edit');
Route::put('/ads/{ad}/edit', [AdController::class, 'update'])->name('ads.update');
Route::delete('/ads/{ad}', [AdController::class, 'destroy'])->name('ads.destroy');
//Route::put('ads/{ad}/upgrade', )

// FILTER BY CATEGORY
Route::get('/category', [CategoryController::class, 'show'])->name('categories.show');

// SEARCH BY KEYWORD
Route::get('/search', [AdController::class, 'search'])->name('index.search');

// BIDS
Route::post('ads/{ad}', [BidController::class, 'store'])->name('bids.store');

// MESSAGES
Route::get('messages', [MessageController::class, 'index'])->name('messages.index');
Route::get('messages/create', [MessageController::class, 'create'])->name('messages.create');
Route::post('messages/create', [MessageController::class, 'store'])->name('messages.store');

// NOTIFICATIONS 
Route::put('/dashboard/update-notifications', [UserController::class, 'updateNotifications'])->name('dashboard.update-notifications');

// PASSWORD UPDATE ROUTES, IN ORDER OF APPEARANCE

Route::get('/forgot-password', [LoginController::class, 'passwordRequest'])->name('password.request');
Route::post('/forgot-password', [LoginController::class, 'passwordEmail'])->name('password.email');
Route::get('/reset-password/{token}', [LoginController::class, 'passwordReset'])->name('password.reset');
Route::post('/reset-password', [LoginController::class, 'passwordUpdate'])->name('password.update');
