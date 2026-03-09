<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogVideo extends Model
{
    protected $fillable = [
        'video_theme_id',
        'title',
        'video_url',
        'thumbnail',
        'description',
        'is_active',
        'sort_order'
    ];

    public function theme()
    {
        return $this->belongsTo(VideoTheme::class, 'video_theme_id');
    }
}
