<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductWishlistController extends Controller
{
    public function store(Product $product)
    {
        // Cek apakah sudah login
        if (!Auth::check()) {
            return response()->json(['status' => 'unauthenticated'], 401);
        }

        // Tambah Wishlist
        Auth::user()->wishlist()->syncWithoutDetaching([$product->id]);

        return response()->json(['status' => 'added']);
    }

    public function destroy(Product $product)
    {
        // Cek apakah sudah login
        if (!Auth::check()) {
            return response()->json(['status' => 'unauthenticated'], 401);
        }

        // Hapus Wishlist
        Auth::user()->wishlist()->detach($product->id);

        return response()->json(['status' => 'removed']);
    }
}
