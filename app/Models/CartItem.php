<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $fillable = [
        'user_id',
        'guest_id',
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

    public static function syncSessionCart($userId, $guestId = null)
    {
        $cart = session()->get('cart', []);

        // If logged in, prioritize user_id but also check for guest items to migrate
        if ($userId) {
            // 1. Sync session items to user account
            foreach ($cart as $id => $details) {
                self::updateOrCreate(
                    ['user_id' => $userId, 'product_id' => $id],
                    ['quantity' => $details['quantity'], 'guest_id' => null]
                );
            }

            // 2. Clear guest entries from session cart as they are now in DB
            // (But we keep session cart for performance/badge logic)

            // 3. Migrate any items previously saved under guest_id to user_id
            if ($guestId) {
                $guestItems = self::where('guest_id', $guestId)->get();
                foreach ($guestItems as $item) {
                    $existingUserItem = self::where('user_id', $userId)
                        ->where('product_id', $item->product_id)
                        ->first();

                    if ($existingUserItem) {
                        // If same product exists, take the higher quantity or guest quantity
                        $existingUserItem->update(['quantity' => max($existingUserItem->quantity, $item->quantity)]);
                        $item->delete();
                    } else {
                        $item->update(['user_id' => $userId, 'guest_id' => null]);
                    }
                }
            }
        }
        // If not logged in, sync session to guest_id in DB
        elseif ($guestId) {
            foreach ($cart as $id => $details) {
                self::updateOrCreate(
                    ['guest_id' => $guestId, 'product_id' => $id],
                    ['quantity' => $details['quantity'], 'user_id' => null]
                );
            }
        }
    }
}
