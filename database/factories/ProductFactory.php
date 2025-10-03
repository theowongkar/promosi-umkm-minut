<?php

namespace Database\Factories;

use App\Models\Business;
use App\Models\ProductCategory;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->words(3, true);

        return [
            'business_id' => Business::inRandomOrder()->first()->id,
            'product_category_id' => ProductCategory::inRandomOrder()->first()->id,
            'name' => ucfirst($name),
            'slug' => Str::slug($name) . '-' . Str::random(5),
            'description' => fake()->paragraph(),
            'price' => fake()->numberBetween(10000, 1000000),
            'qr_code' => null,
            'status' => fake()->randomElement(['Menunggu Persetujuan', 'Diterima', 'Ditolak']),
        ];
    }
}
