<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Business;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class BusinessController extends Controller
{
    public function index(Request $request)
    {
        // Validasi Input
        $validated = $request->validate([
            'business_type' => 'nullable|string|in:Mikro,Kecil,Menengah',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'search' => 'nullable|string|min:1',
        ]);

        // Ambil Nilai
        $business_type = $validated['business_type'] ?? null;
        $start_date = $validated['start_date'] ?? null;
        $end_date = $validated['end_date'] ?? null;
        $search = $validated['search'] ?? null;

        // Ambil Semua Usaha
        $businesses = Business::with('category', 'products')->when($search, function ($query, $search) {
            return $query->where(function ($query) use ($search) {
                $query->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('owner_name', 'LIKE', "%{$search}%")
                    ->orWhere('owner_nik', 'LIKE', "%{$search}%");
            });
        })
            ->when($business_type, function ($query, $business_type) {
                return $query->where('business_type', $business_type);
            })
            ->when($start_date, function ($query) use ($start_date) {
                return $query->whereDate('created_at', '>=', $start_date);
            })
            ->when($end_date, function ($query) use ($end_date) {
                return $query->whereDate('created_at', '<=', $end_date);
            })
            ->orderBy('created_at', 'DESC')
            ->paginate(20);

        return view('dashboard.businesses.index', compact('businesses'));
    }

    public function pdf()
    {
        $businesses = Business::with('category', 'products')->get();

        $pdf = Pdf::loadView('dashboard.businesses.pdf', compact('businesses'))
            ->setPaper('a4', 'landscape');

        return $pdf->stream('data-umkm.pdf');
    }


    public function show(Business $business)
    {
        // Ambil Usaha
        $business->with('category', 'products', 'owner');

        return view('dashboard.businesses.show', compact('business'));
    }

    public function destroy(Business $business)
    {
        // Hapus file gambar di storage jika ada
        if (!empty($business->image_path) && Storage::exists($business->image_path)) {
            Storage::delete($business->image_path);
        }

        // Hapus Usaha
        $business->delete();

        return redirect()->route('dashboard.business.index')->with('success', 'Usaha berhasil dihapus.');
    }
}
