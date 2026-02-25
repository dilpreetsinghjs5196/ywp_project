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
        'weekly_availability',
        'office_address',
        'weekly_addresses',
        'date_addresses',
        'google_id',
        'google_calendar_id',
        'google_access_token',
        'google_refresh_token',
        'google_token_expires_at'
    ];

    protected $casts = [
        'availability' => 'array',
        'weekly_availability' => 'array',
        'weekly_addresses' => 'array',
        'date_addresses' => 'array',
        'is_active' => 'boolean'
    ];

    public function services()
    {
        return $this->belongsToMany(Service::class, 'service_team', 'team_id', 'service_id')->withPivot('fees', 'duration')->withTimestamps();
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
