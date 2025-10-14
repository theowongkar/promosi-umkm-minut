<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use App\Models\ProductCategory;
use Illuminate\Database\Seeder;
use App\Models\BusinessCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductionSeeder extends Seeder
{
    /**
     * Run the database seeds.
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
    }
}
