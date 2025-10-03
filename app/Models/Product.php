<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory, Sluggable;

    protected $fillable = [
        'business_id',
        'product_category_id',
        'name',
        'slug',
        'description',
        'price',
        'qr_code',
        'status',
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
     * Relasi: Produk dimiliki oleh bisnis
     */
    public function business()
    {
        return $this->belongsTo(Business::class, 'business_id');
    }

    /**
     * Relasi: Produk termasuk kategori produk
     */
    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }

    /**
     * Relasi: Produk memiliki banyak gambar
     */
    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }

    /**
     * Relasi: Ambil gambar pertama (primary)
     */
    public function primaryImage()
    {
        return $this->hasOne(ProductImage::class, 'product_id')->oldest();
    }

    /**
     * Relasi: Produk memiliki banyak review
     */
    public function reviews()
    {
        return $this->hasMany(ProductReview::class, 'product_id');
    }

    /**
     * Hitung rata-rata rating produk
     */
    public function averageRating()
    {
        return round($this->reviews()->avg('rating'), 1);
    }

    /**
     * Relasi: Produk di-wishlist oleh banyak user
     */
    public function wishedBy()
    {
        return $this->belongsToMany(User::class, 'product_wishlists')
            ->withTimestamps();
    }
}
