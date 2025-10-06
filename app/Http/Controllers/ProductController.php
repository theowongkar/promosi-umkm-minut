<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductCategory;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // Validasi Input
        $validated = $request->validate([
            'search' => 'nullable|string|max:100',
            'category' => 'nullable|string|max:100',
        ]);

        // Ambil Nilai
        $search = $validated['search'] ?? null;
        $category = $validated['category'] ?? null;


        // Ambil kategori produk
        $productCategories = ProductCategory::all();

        // Query dasar produk
        $query = Product::with(['primaryImage', 'category'])
            ->withAvg('reviews', 'rating')
            ->where('status', 'Diterima');

        // Filter berdasarkan pencarian nama
        if ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        // Filter berdasarkan kategori
        if ($category) {
            $query->whereHas('category', function ($q) use ($category) {
                $q->where('slug', $category);
            });
        }

        // Urutkan dari rating tertinggi
        $products = $query->orderByDesc('reviews_avg_rating')->paginate(25);

        // Kirim ke view
        return view('products.index', compact('productCategories', 'products', 'search', 'category'));
    }

    public function show(string $slug)
    {
        // Ambil produk berdasarkan slug
        $product = Product::with([
            'category',
            'images',
            'reviews' => function ($query) {
                $query->latest()->with('user');
            },
        ])
            ->where('status', 'Diterima')
            ->where('slug', $slug)
            ->firstOrFail();

        return view('products.show', compact('product'));
    }
}
