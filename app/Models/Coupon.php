<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = [
        'user_name',
        'user_email',
        'code',
        'discount_amount',
        'status'
    ];
}
