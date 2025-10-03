<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    /** @use HasFactory<\Database\Factories\ProductCategoryFactory> */
    use HasFactory, Sluggable;

    protected $fillable = [
        'name',
        'slug',
        'image_path',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ],
        ];
    }

    /**
     * Relasi: Kategori produk memiliki banyak produk
     */
    public function products()
    {
        return $this->hasMany(Product::class, 'product_category_id');
    }
}
