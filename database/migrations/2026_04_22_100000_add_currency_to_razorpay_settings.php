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
            ['key' => 'razorpay_currency'],
            ['value' => 'INR', 'group' => 'razorpay', 'type' => 'text']
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        \App\Models\SiteSetting::where('key', 'razorpay_currency')->delete();
    }
};
