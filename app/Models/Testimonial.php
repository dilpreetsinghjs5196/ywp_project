<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = [
        'client_name',
        'designation',
        'client_image',
        'feedback',
        'rating',
        'sort_order',
        'is_active'
    ];
}
