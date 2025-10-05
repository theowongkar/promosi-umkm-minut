<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/mulai-berjualan', [HomeController::class, 'sellingGuide'])->name('selling-guide');
Route::get('/ikuti-kami', [HomeController::class, 'followUs'])->name('follow-us');
Route::get('/pusat-bantuan', [HomeController::class, 'helpCenter'])->name('help-center');
