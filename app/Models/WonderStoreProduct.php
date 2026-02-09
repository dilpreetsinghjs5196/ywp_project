<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WonderStoreProduct extends Model
{
    protected $fillable = [
        'product_image',
        'category_id',
        'product_description',
        'product_price',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'product_price' => 'decimal:2'
    ];

    public function category()
    {
        return $this->belongsTo(WonderStoreCategory::class, 'category_id');
    }
}
