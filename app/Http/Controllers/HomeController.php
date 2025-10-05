<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil Kategori Produk
        $productCategories = ProductCategory::get();

        // Ambil Produk
        $products = Product::with('primaryImage')
            ->withAvg('reviews', 'rating')
            ->where('status', 'Diterima')
            ->orderByDesc('reviews_avg_rating')
            ->limit(25)
            ->get();

        return view('index', compact('productCategories', 'products'));
    }

    public function sellingGuide()
    {
        return view('selling-guide');
    }

    public function followUs()
    {
        return view('follow-us');
    }

    public function helpCenter()
    {
        return view('help-center');
    }
}
