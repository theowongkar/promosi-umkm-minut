<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'google_id',
        'google_token',
        'google_refresh_token',
        'role',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relasi: User memiliki banyak bisnis
     */
    public function businesses()
    {
        return $this->hasMany(Business::class, 'user_id');
    }

    /**
     * Relasi: User memiliki banyak review
     */
    public function reviews()
    {
        return $this->hasMany(ProductReview::class, 'user_id');
    }

    /**
     * Relasi: User memiliki wishlist produk
     */
    public function wishlist()
    {
        return $this->belongsToMany(Product::class, 'product_wishlists')
            ->withTimestamps();
    }

    /**
     * Relasi: User memiliki banyak produk melalui bisnis
     */
    public function products()
    {
        return $this->hasManyThrough(Product::class, Business::class, 'user_id', 'business_id');
    }
}
