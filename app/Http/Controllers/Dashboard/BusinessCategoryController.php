<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\BusinessCategory;
use Illuminate\Http\Request;

class BusinessCategoryController extends Controller
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
        $businessCategories = BusinessCategory::when($search, function ($query, $search) {
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

        return view('dashboard.business-categories.index', compact('businessCategories'));
    }

    public function store(Request $request)
    {
        // Validasi Input
        $validated = $request->validate([
            'name' => 'required|string|max:50|unique:business_categories,name',
        ]);

        // Tambah Kategori Bisnis
        BusinessCategory::create($validated);

        return redirect()->back()->with('success', 'Data kategori bisnis berhasil ditambahkan!');
    }

    public function update(Request $request, BusinessCategory $businessCategory)
    {
        // Validasi Input
        $validated = $request->validate([
            'name' => 'required|string|max:50|unique:business_categories,name,' . $businessCategory->id,
        ]);

        // Ubah Kategori Bisnis
        $businessCategory->update($validated);

        return redirect()->back()->with('success', 'Data kategori bisnis berhasil diperbarui!');
    }

    public function destroy(BusinessCategory $businessCategory)
    {
        // Hapus Kategori Bisnis
        $businessCategory->delete();

        return redirect()->back()->with('success', 'Data kategori bisnis berhasil dihapus!');
    }
}
