<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = [
        'name',
        'email',
        'designation',
        'fees',
        'image',
        'description',
        'facebook',
        'twitter',
        'instagram',
        'linkedin',
        'sort_order',
        'is_active',
        'availability'
    ];

    protected $casts = [
        'availability' => 'array',
        'is_active' => 'boolean'
    ];

    public function services()
    {
        return $this->belongsToMany(Service::class, 'service_team', 'team_id', 'service_id');
    }
}
