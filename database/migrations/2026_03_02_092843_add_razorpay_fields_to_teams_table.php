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
        Schema::table('teams', function (Illuminate\Database\Schema\Blueprint $table) {
            $table->decimal('commission_percentage', 5, 2)->default(0)->after('fees');
            $table->string('razorpay_account_id')->nullable()->after('commission_percentage');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('teams', function (Illuminate\Database\Schema\Blueprint $table) {
            $table->dropColumn(['commission_percentage', 'razorpay_account_id']);
        });
    }
};
