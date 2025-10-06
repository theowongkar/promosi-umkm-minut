<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductReview;
use Illuminate\Support\Facades\Auth;

class ProductReviewController extends Controller
{
    public function upsert(Request $request, $productId)
    {
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
        ]);

        $userId = Auth::id();

        // Cari review user untuk produk ini
        $review = ProductReview::where('product_id', $productId)
            ->where('user_id', $userId)
            ->first();

        if ($review) {
            // Jika sudah ada, update
            $review->update($validated);
            $message = 'Ulasan berhasil diperbarui!';
        } else {
            // Jika belum ada, buat baru
            ProductReview::create([
                'product_id' => $productId,
                'user_id' => $userId,
                'rating' => $validated['rating'],
                'comment' => $validated['comment'],
            ]);
            $message = 'Ulasan berhasil disimpan!';
        }

        return redirect()->back()->with('success', $message);
    }

    public function destroy(ProductReview $review)
    {
        // Cek apakah user pemilik review
        if ($review->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Hapus Review
        $review->delete();

        return redirect()->back()->with('success', 'Ulasan berhasil dihapus!');
    }
}
