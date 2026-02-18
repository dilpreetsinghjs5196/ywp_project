<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'team_id',
        'name',
        'email',
        'rating',
        'comment',
        'is_anonymous',
        'status'
    ];

    protected $casts = [
        'is_anonymous' => 'boolean',
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
