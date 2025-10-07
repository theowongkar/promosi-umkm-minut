<?php

namespace App\Http\Controllers;

use App\Models\Business;
use Illuminate\Http\Request;
use App\Models\BusinessCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class BusinessController extends Controller
{
    public function myBusinessIndex()
    {
        // Batasi hak akses
        Gate::authorize('viewAny', Business::class);

        // Ambil User
        $user = Auth::user();

        // Ambil semua bisnis milik user beserta produknya
        $businesses = $user->businesses()->with(['products.category', 'products.reviews', 'category'])
            ->with(['products' => fn($q) => $q->withCount('reviews')])
            ->latest()
            ->get();

        return view('my-businesses.index', compact('businesses'));
    }

    public function myBusinessCreate()
    {
        // Batasi hak akses
        Gate::authorize('create', Business::class);

        // Ambil Business Categories
        $businessCategories = BusinessCategory::all();

        return view('my-businesses.create', compact('businessCategories'));
    }

    public function myBusinessStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:businesses,name',
            'business_category_id' => 'required|exists:business_categories,id',
            'business_type' => 'required|in:Mikro,Kecil,Menengah',
            'image_path' => 'nullable|image|max:2048',
            'owner_name' => 'required|string|max:100',
            'owner_nik' => 'required|digits:16',
            'owner_phone' => 'required|string|max:20',
            'province' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'village' => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::id();

        // Upload gambar jika ada
        if ($request->hasFile('image_path')) {
            $data['image_path'] = $request->file('image_path')->store('businesses', 'public');
        }

        // Simpan ke database
        Business::create($data);

        return redirect()->back()->with('success', 'Usaha berhasil ditambahkan!');
    }

    public function myBusinessEdit(Business $business)
    {
        // Batasi hak akses
        Gate::authorize('update', $business);

        // Ambil Business Categories
        $businessCategories = BusinessCategory::all();

        return view('my-businesses.edit', compact('business', 'businessCategories'));
    }

    public function myBusinessUpdate(Request $request, Business $business)
    {
        // Batasi hak akses
        Gate::authorize('update', $business);

        if ($request->action === 'delete') {
            // Hapus file gambar (jika ada)
            if ($business->image_path && file_exists(storage_path('app/public/' . $business->image_path))) {
                unlink(storage_path('app/public/' . $business->image_path));
            }

            // Hapus data usaha dari database
            $business->delete();

            return redirect()->route('my-business.index')->with('success', 'Data usaha berhasil dihapus.');
        }

        $validated = $request->validate([
            'business_category_id' => 'required|exists:business_categories,id',
            'name' => 'required|string|max:100',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'owner_name' => 'required|string|max:100',
            'owner_nik' => 'required|string|size:16',
            'owner_phone' => 'required|string|max:20',
            'province' => 'required|string',
            'city' => 'required|string',
            'district' => 'required|string',
            'village' => 'required|string',
            'address' => 'required|string',
            'business_type' => 'required|in:Mikro,Kecil,Menengah',
        ]);

        // upload file baru (jika ada)
        if ($request->hasFile('image_path')) {
            if ($business->image_path && file_exists(storage_path('app/public/' . $business->image_path))) {
                unlink(storage_path('app/public/' . $business->image_path));
            }

            $validated['image_path'] = $request->file('image_path')->store('businesses', 'public');
        }

        $business->update($validated);

        return redirect()->back()->with('success', 'Data usaha berhasil diperbarui!');
    }
}
