<?php

use App\Models\Team;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('it can calculate therapist split correctly', function () {
    // 1. Create a therapist
    $therapist = Team::create([
        'name' => 'Dr. Pest Test',
        'email' => 'pest@example.com',
        'designation' => 'Psychologist',
        'fees' => 1500,
        'commission_percentage' => 10,
        'razorpay_account_id' => 'acc_TEST123',
        'is_active' => true,
    ]);

    // Calculate split: 1500 - 10% = 1350
    $amount = 1500;
    $commission = (float) $therapist->commission_percentage;
    $therapistShare = $amount * (100 - $commission) / 100;

    expect($therapistShare)->toBe(1350.0);

    // In paise
    $therapistSharePaise = (int) round($therapistShare * 100);
    expect($therapistSharePaise)->toBe(135000);
});
