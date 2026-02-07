<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = [
        'name',
        'designation',
        'image',
        'facebook',
        'twitter',
        'instagram',
        'linkedin',
        'sort_order',
        'is_active'
    ];
}
