<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TherapistBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'team_id',
        'service_id',
        'therapist_id',
        'name',
        'email',
        'phone',
        'booking_date',
        'booking_time',
        'mode',
        'message',
        'amount',
        'payment_status',
        'razorpay_payment_id',
        'razorpay_order_id',
        'razorpay_signature'
    ];

    public function therapist()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }
}
