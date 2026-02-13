<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'icon',
        'icon_image',
        'description',
        'goals',
        'image',
        'sort_order',
        'is_active'
    ];
}
