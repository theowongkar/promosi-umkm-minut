<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Str;
use App\Models\BusinessCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Business>
 */
class BusinessFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->company();

        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'business_category_id' => BusinessCategory::inRandomOrder()->first()->id,
            'name' => $name,
            'slug' => Str::slug($name),
            'image_path' => null,
            'owner_name' => fake()->name(),
            'owner_nik' => fake()->numerify('###############'),
            'owner_phone' => fake()->phoneNumber(),
            'province' => fake()->state(),
            'city' => fake()->city(),
            'district' => fake()->citySuffix(),
            'village' => fake()->streetName(),
            'address' => fake()->address(),
            'business_type' => fake()->randomElement(['Mikro', 'Kecil', 'Menengah']),
        ];
    }
}
