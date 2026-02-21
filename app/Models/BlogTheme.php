<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogTheme extends Model
{
    protected $fillable = ['name', 'slug', 'is_active', 'sort_order'];

    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }
}
