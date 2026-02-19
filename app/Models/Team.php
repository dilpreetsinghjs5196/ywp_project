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
        'mode',
        'languages',
        'specialization',
        'specialties',
        'qualifications',
        'session_type',
        'facebook',
        'twitter',
        'instagram',
        'linkedin',
        'sort_order',
        'is_active',
        'availability',
        'availability_type',
        'weekly_availability'
    ];

    protected $casts = [
        'availability' => 'array',
        'weekly_availability' => 'array',
        'is_active' => 'boolean'
    ];

    public function services()
    {
        return $this->belongsToMany(Service::class, 'service_team', 'team_id', 'service_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function approvedReviews()
    {
        return $this->hasMany(Review::class)->where('status', 'approved');
    }
}
