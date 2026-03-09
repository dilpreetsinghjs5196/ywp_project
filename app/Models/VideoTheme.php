<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VideoTheme extends Model
{
    protected $fillable = ['name', 'slug', 'description', 'is_active', 'sort_order'];

    public function videos()
    {
        return $this->hasMany(BlogVideo::class);
    }
}
