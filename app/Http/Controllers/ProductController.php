<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Business;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Auth;

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

    public function myProductCreate(Business $business)
    {
        // Ambil Kategori Produk
        $productCategories = ProductCategory::all();

        return view('my-products.create', compact('business', 'productCategories'));
    }

    public function myProductStore(Request $request, Business $business)
    {
        // Validasi Input
        $validated = $request->validate([
            'product_category_id' => 'required|exists:product_categories,id',
            'name' => 'required|string|max:100',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Isi bisnis terkait
        $validated['business_id'] = $business->id;

        // Simpan Produk
        $product = Product::create($validated);

        // Upload gambar jika ada
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $img) {
                $path = $img->store('products', 'public');
                $product->images()->create(['image_path' => $path]);
            }
        }

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan!');
    }

    public function myProductEdit(Business $business, Product $product)
    {
        // Ambil semua kategori produk
        $productCategories = ProductCategory::all();

        return view('my-products.edit', compact('business', 'product', 'productCategories'));
    }


    public function myProductUpdate(Request $request, Business $business, Product $product)
    {
        if ($request->action == 'delete') {
            // Hapus semua gambar yang terkait
            foreach ($product->images as $image) {
                $filePath = storage_path('app/public/' . $image->image_path);
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
                $image->delete(); // hapus data relasi di database
            }

            // Setelah gambar dihapus, hapus produknya
            $product->delete();

            return redirect()
                ->route('my-business.index')
                ->with('success', 'Data produk dan gambar berhasil dihapus.');
        }

        // Validasi Input
        $validated = $request->validate([
            'product_category_id' => 'required|exists:product_categories,id',
            'name' => 'required|string|max:100',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Update data produk
        $product->update($validated);

        // Kalau ada gambar baru
        if ($request->hasFile('images')) {
            // 1️⃣ Hapus semua gambar lama terlebih dahulu
            foreach ($product->images as $image) {
                $filePath = storage_path('app/public/' . $image->image_path);
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
                $image->delete();
            }

            // 2️⃣ Upload gambar baru
            foreach ($request->file('images') as $img) {
                $path = $img->store('products', 'public');
                $product->images()->create(['image_path' => $path]);
            }
        }

        return redirect()->back()->with('success', 'Produk berhasil diperbarui!');
    }
}
