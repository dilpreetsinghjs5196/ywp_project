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
        Schema::table('orders', function (Blueprint $table) {
            $table->text('permanent_address')->nullable()->after('country');
            $table->string('permanent_city')->nullable()->after('permanent_address');
            $table->string('permanent_state')->nullable()->after('permanent_city');
            $table->string('permanent_postcode')->nullable()->after('permanent_state');
            $table->string('permanent_country')->nullable()->after('permanent_postcode');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            //
        });
    }
};
