<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProductReviewController;
use App\Http\Controllers\ProductWishlistController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/mulai-berjualan', [HomeController::class, 'sellingGuide'])->name('selling-guide');
Route::get('/ikuti-kami', [HomeController::class, 'followUs'])->name('follow-us');
Route::get('/pusat-bantuan', [HomeController::class, 'helpCenter'])->name('help-center');

// Produk
Route::get('/produk', [ProductController::class, 'index'])->name('product.index');
Route::get('/produk/{slug}', [ProductController::class, 'show'])->name('product.show');

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

    // Edit Profil
    Route::get('/profil-saya', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profil-saya', [ProfileController::class, 'update'])->name('profile.update');

    // Wishlist Produk
    Route::post('/wishlist/{product}', [ProductWishlistController::class, 'store'])->name('wishlist.store');
    Route::delete('/wishlist/{product}', [ProductWishlistController::class, 'destroy'])->name('wishlist.destroy');

    // Review Produk
    Route::post('/products/{product}/review', [ProductReviewController::class, 'upsert'])->name('product-review.upsert');
    Route::delete('/review/{product}', [ProductReviewController::class, 'destroy'])->name('product-review.destroy');
});
