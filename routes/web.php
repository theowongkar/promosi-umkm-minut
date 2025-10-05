<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/mulai-berjualan', [HomeController::class, 'sellingGuide'])->name('selling-guide');
Route::get('/ikuti-kami', [HomeController::class, 'followUs'])->name('follow-us');
Route::get('/pusat-bantuan', [HomeController::class, 'helpCenter'])->name('help-center');

Route::middleware('guest')->group(function () {
    // Login
    Route::get('/login', [LoginController::class, 'login'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate'])->middleware('throttle:5,5');

    // Register
    Route::get('/register', [RegisterController::class, 'register'])->name('register');
    Route::post('/register', [RegisterController::class, 'store'])->middleware('throttle:5,5');
});

Route::middleware('auth')->group(function () {
    // Logout
    Route::post('/logout', [LoginController::class, 'logout'])->middleware('throttle:5,5')->name('logout');
});
