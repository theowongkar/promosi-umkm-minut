<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Product;
use App\Models\Business;
use App\Models\ProductReview;
use Illuminate\Database\Seeder;
use App\Models\BusinessCategory;
use App\Models\ProductCategory;

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
            'Aktifitas Jasa Lainnya',
        ];

        foreach ($businessCategories as $businessCategory) {
            BusinessCategory::factory()->create([
                'name' => $businessCategory,
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
        ];

        foreach ($productCategories as $productCategory) {
            ProductCategory::factory()->create([
                'name' => $productCategory,
            ]);
        }

        // Buat Produk
        Product::factory(25)->create();

        // Buat Review
        ProductReview::factory(50)->create();
    }
}
