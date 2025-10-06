<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Product;
use App\Models\Business;
use Illuminate\Support\Str;
use App\Models\ProductReview;
use App\Models\ProductCategory;
use Illuminate\Database\Seeder;
use App\Models\BusinessCategory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Buat User Admin
        User::factory()->create([
            'name' => 'Administrator',
            'email' => 'admin@gmail.com',
            'role' => 'Admin',
            'status' => 'Aktif',
        ]);

        // Buat User
        User::factory(24)->create();

        // Buat Kategori Bisnis
        $businessCategories = [
            'Perdagangan Besar & Eceran',
            'Industri Pengolahan',
            'Konstruksi',
            'Informasi & Komunikasi',
            'Penyediaan Akomodasi & Penyediaan Makan Minum',
            'Pariwisata',
            'Aktifitas Jasa Lainnya',
        ];

        foreach ($businessCategories as $businessCategory) {
            BusinessCategory::factory()->create([
                'name' => $businessCategory,
                'slug' => Str::slug($businessCategory),
            ]);
        }

        // Buat Bisnis
        Business::factory(25)->create();

        // Buat Kategori Produk
        $productCategories = [
            "Makanan & Minuman",
            "Fashion & Aksesoris",
            "Kecantikan & Perawatan",
            "Elektronik & Gadget",
            "Kerajinan & Handmade",
            "Rumah Tangga & Properti",
            "Pertanian, Perikanan & Peternakan",
            "Jasa & Layanan",
            "Destinasi Wisata"
        ];

        foreach ($productCategories as $productCategory) {
            ProductCategory::factory()->create([
                'name' => $productCategory,
                'slug' => Str::slug($productCategory),
            ]);
        }

        // Buat Produk
        Product::factory(25)->create();

        // Buat Review
        ProductReview::factory(50)->create();
    }
}
