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
        Schema::table('therapist_bookings', function (Blueprint $table) {
            $table->foreignId('service_id')->nullable()->after('team_id')->constrained()->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('therapist_bookings', function (Blueprint $table) {
            $table->dropConstrainedForeignId('service_id');
        });
    }
};
