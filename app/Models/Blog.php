<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'blog_theme_id',
        'title',
        'slug',
        'summary',
        'content',
        'image',
        'is_active',
        'sort_order',
        'published_at'
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    public function theme()
    {
        return $this->belongsTo(BlogTheme::class, 'blog_theme_id');
    }
}
