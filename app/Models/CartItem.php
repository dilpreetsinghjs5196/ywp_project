<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(WonderStoreProduct::class, 'product_id');
    }

    public static function syncSessionCart($userId)
    {
        if (!$userId)
            return;
        $cart = session()->get('cart', []);
        foreach ($cart as $id => $details) {
            self::updateOrCreate(
                ['user_id' => $userId, 'product_id' => $id],
                ['quantity' => $details['quantity']]
            );
        }
    }
}
