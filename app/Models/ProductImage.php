<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    /** @use HasFactory<\Database\Factories\ProductImageFactory> */
    use HasFactory;

    protected $fillable = [
        'product_id',
        'image_path',
    ];

    /**
     * Relasi: Gambar milik produk
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
