<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    protected $fillable = [
        'category_id', 'name', 'slug', 'description', 'short_description',
        'price', 'sale_price', 'stock', 'sku', 'image', 'gallery',
        'specs', 'is_featured', 'is_active'
    ];

    protected $casts = [
        'price'       => 'decimal:2',
        'sale_price'  => 'decimal:2',
        'gallery'     => 'array',
        'specs'       => 'array',
        'is_featured' => 'boolean',
        'is_active'   => 'boolean',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function getCurrentPriceAttribute(): float
    {
        return (float)($this->sale_price ?? $this->price);
    }

    public function getDiscountPercentAttribute(): int
    {
        if (!$this->sale_price) return 0;
        return (int)(($this->price - $this->sale_price) / $this->price * 100);
    }

    public function getImageAttribute(?string $value): string
    {
        if (empty($value)) {
            return asset('images/product-fallback.svg');
        }
        if (str_starts_with($value, 'http://') || str_starts_with($value, 'https://')) {
            return $value;
        }
        if (str_starts_with($value, 'images/') || str_starts_with($value, 'storage/')) {
            return asset($value);
        }
        return asset('images/products/' . ltrim($value, '/'));
    }

    public function getImageUrlAttribute(): string
    {
        return $this->image;
    }
}

