<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductWishlistController extends Controller
{
    public function index()
    {
        // Cek login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Ambil semua produk di wishlist user
        $wishlistProducts = Auth::user()->wishlist()->with('category')->get();

        // Kirim ke view
        return view('wishlists.index', compact('wishlistProducts'));
    }

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
