<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // Validasi Input
        $validated = $request->validate([
            'status' => 'nullable|in:Menunggu Persetujuan,Diterima,Ditolak',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'search' => 'nullable|string|min:1',
        ]);

        // Ambil Nilai
        $status = $validated['status'] ?? null;
        $start_date = $validated['start_date'] ?? null;
        $end_date = $validated['end_date'] ?? null;
        $search = $validated['search'] ?? null;

        // Ambil Semua Produk
        $products = Product::with('category', 'business')->when($search, function ($query, $search) {
            return $query->where(function ($query) use ($search) {
                $query->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('owner_nik', 'LIKE', "%{$search}%");
            });
        })
            ->when($status, function ($query, $status) {
                return $query->where('status', $status);
            })
            ->when($start_date, function ($query) use ($start_date) {
                return $query->whereDate('created_at', '>=', $start_date);
            })
            ->when($end_date, function ($query) use ($end_date) {
                return $query->whereDate('created_at', '<=', $end_date);
            })
            ->orderBy('created_at', 'DESC')
            ->paginate(20);

        return view('dashboard.products.index', compact('products'));
    }

    public function edit(Product $product)
    {
        $product->load('category', 'business', 'images');

        return view('dashboard.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'status' => 'required|in:Menunggu Persetujuan,Diterima,Ditolak',
        ]);

        $product->status = $validated['status'];
        $product->save();

        return redirect()->route('dashboard.product.index')->with('success', 'Status produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        // Hapus gambar terkait jika ada
        if ($product->images) {
            foreach ($product->images as $image) {
                if (!empty($image->path) && Storage::exists($image->path)) {
                    Storage::delete($image->path);
                }
                $image->delete();
            }
        }

        $product->delete();

        return redirect()->route('dashboard.product.index')->with('success', 'Produk berhasil dihapus.');
    }
}
