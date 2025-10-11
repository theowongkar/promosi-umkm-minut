<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\Dashboard\DashboardController;
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

Route::middleware('auth', 'isActiveUser')->group(function () {
    // Logout
    Route::post('/logout', [LoginController::class, 'logout'])->middleware('throttle:5,5')->name('logout');

    // Edit Profil
    Route::get('/profil-saya', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profil-saya', [ProfileController::class, 'update'])->middleware('throttle:5,5')->name('profile.update');

    // Usaha Saya
    Route::get('/usaha-saya', [BusinessController::class, 'myBusinessIndex'])->name('my-business.index');
    Route::get('/usaha-saya/tambah', [BusinessController::class, 'myBusinessCreate'])->name('my-business.create');
    Route::post('/usaha-saya/tambah', [BusinessController::class, 'myBusinessStore'])->name('my-business.store');
    Route::get('/usaha-saya/{business:slug}/ubah', [BusinessController::class, 'myBusinessEdit'])->name('my-business.edit');
    Route::put('/usaha-saya/{business:slug}/ubah', [BusinessController::class, 'myBusinessUpdate'])->name('my-business.update');

    // Produk Saya
    Route::get('/usaha-saya/{business:slug}/produk/tambah', [ProductController::class, 'myProductCreate'])->name('my-product.create');
    Route::post('/usaha-saya/{business:slug}/produk/tambah', [ProductController::class, 'myProductStore'])->name('my-product.store');
    Route::get('/usaha-saya/{business:slug}/produk/{product:slug}/ubah', [ProductController::class, 'myProductEdit'])->name('my-product.edit');
    Route::put('/usaha-saya/{business:slug}/produk/{product:slug}/ubah', [ProductController::class, 'myProductUpdate'])->name('my-product.update');
    Route::delete('/usaha-saya/{business:slug}/produk/{product:slug}', [ProductController::class, 'myProductDestroy'])->name('my-product.destroy');
    Route::delete('/usaha-saya/{business:slug}/produk/{product:slug}/gambar/{image}', [ProductController::class, 'destroyImage'])->name('my-product.image.destroy');


    // Wishlist Produk
    Route::get('/wishlist-saya', [ProductWishlistController::class, 'index'])->name('product-wishlist.index');
    Route::post('/wishlist/{product}', [ProductWishlistController::class, 'store'])->name('product-wishlist.store');
    Route::delete('/wishlist/{product}', [ProductWishlistController::class, 'destroy'])->name('product-wishlist.destroy');

    // Review Produk
    Route::post('/review/{product}', [ProductReviewController::class, 'upsert'])->middleware('throttle:5,5')->name('product-review.upsert');
    Route::delete('/review/{product}', [ProductReviewController::class, 'destroy'])->middleware('throttle:5,5')->name('product-review.destroy');
});

Route::middleware('auth', 'isActiveUser', 'isAdmin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});
