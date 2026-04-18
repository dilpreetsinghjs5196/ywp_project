<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeHeroSlide extends Model
{
    protected $fillable = ['image', 'title', 'subtitle', 'button_text', 'button_link', 'order'];
}
