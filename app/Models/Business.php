<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    /** @use HasFactory<\Database\Factories\BusinessFactory> */
    use HasFactory, Sluggable;

    protected $fillable = [
        'user_id',
        'business_category_id',
        'name',
        'slug',
        'image_path',
        'owner_name',
        'owner_nik',
        'owner_phone',
        'province',
        'city',
        'district',
        'village',
        'address',
        'business_type',
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
     * Relasi: Bisnis dimiliki oleh User
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relasi: Bisnis termasuk ke kategori bisnis
     */
    public function category()
    {
        return $this->belongsTo(BusinessCategory::class, 'business_category_id');
    }

    /**
     * Relasi: Bisnis memiliki banyak produk
     */
    public function products()
    {
        return $this->hasMany(Product::class, 'business_id');
    }
}
