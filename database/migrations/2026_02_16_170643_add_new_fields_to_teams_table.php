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
        Schema::table('teams', function (Blueprint $table) {
            $table->string('mode')->nullable()->after('description');
            $table->string('languages')->nullable()->after('mode');
            $table->text('specialization')->nullable()->after('languages');
            $table->text('specialties')->nullable()->after('specialization');
            $table->text('qualifications')->nullable()->after('specialties');
            $table->string('session_type')->nullable()->after('qualifications');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('teams', function (Blueprint $table) {
            $table->dropColumn(['mode', 'languages', 'specialization', 'specialties', 'qualifications', 'session_type']);
        });
    }
};
