<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ProductCategoryController extends Controller
{
    public function index(Request $request)
    {
        // Validasi Search Form
        $validated = $request->validate([
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'search' => 'nullable|string|min:1',
        ]);

        // Ambil Nilai
        $start_date = $validated['start_date'] ?? null;
        $end_date = $validated['end_date'] ?? null;
        $search = $validated['search'] ?? null;

        // Ambil Semua Kategori Bisnis
        $productCategories = ProductCategory::when($search, function ($query, $search) {
            return $query->where('name', 'LIKE', "%{$search}%");
        })
            ->when($start_date, function ($query) use ($start_date) {
                return $query->whereDate('created_at', '>=', $start_date);
            })
            ->when($end_date, function ($query) use ($end_date) {
                return $query->whereDate('created_at', '<=', $end_date);
            })
            ->orderBy('name', 'ASC')
            ->paginate(20);

        return view('dashboard.product-categories.index', compact('productCategories'));
    }

    public function store(Request $request)
    {
        // Validasi Input
        $validated = $request->validate([
            'name' => 'required|string|max:50|unique:product_categories,name',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // Upload Gambar (jika ada)
        if ($request->hasFile('image_path')) {
            $validated['image_path'] = $request->file('image_path')->store('product_categories', 'public');
        }

        // Tambah Kategori Produk
        ProductCategory::create($validated);

        return redirect()->back()->with('success', 'Data kategori produk berhasil ditambahkan!');
    }

    public function update(Request $request, ProductCategory $productCategory)
    {
        // Validasi Input
        $validated = $request->validate([
            'name' => 'required|string|max:50|unique:product_categories,name,' . $productCategory->id,
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // Upload Gambar (jika ada)
        if ($request->hasFile('image_path')) {
            // Hapus gambar lama (jika ada)
            if ($productCategory->image_path && Storage::disk('public')->exists($productCategory->image_path)) {
                Storage::disk('public')->delete($productCategory->image_path);
            }

            // Simpan gambar baru
            $validated['image_path'] = $request->file('image_path')->store('product_categories', 'public');
        }

        // Update data kategori
        $productCategory->update($validated);

        return redirect()->back()->with('success', 'Data kategori produk berhasil diperbarui!');
    }

    public function destroy(ProductCategory $productCategory)
    {
        // Hapus gambar jika ada
        if ($productCategory->image_path && Storage::disk('public')->exists($productCategory->image_path)) {
            Storage::disk('public')->delete($productCategory->image_path);
        }

        // Hapus data kategori
        $productCategory->delete();

        return redirect()->back()->with('success', 'Data kategori produk berhasil dihapus!');
    }
}
