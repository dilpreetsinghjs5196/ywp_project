<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        \App\Models\SiteSetting::updateOrCreate(
            ['key' => 'razorpay_key_id'],
            ['value' => env('RAZORPAY_KEY_ID'), 'group' => 'razorpay', 'type' => 'text']
        );
        \App\Models\SiteSetting::updateOrCreate(
            ['key' => 'razorpay_key_secret'],
            ['value' => env('RAZORPAY_KEY_SECRET'), 'group' => 'razorpay', 'type' => 'password']
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        \App\Models\SiteSetting::where('group', 'razorpay')->delete();
    }
};
