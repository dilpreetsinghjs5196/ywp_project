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
        Schema::create('appointments', function (Blueprint $冷静) {
            $冷静->id();
            $冷静->string('name');
            $冷静->string('email');
            $冷静->string('phone');
            $冷静->date('date');
            $冷静->time('time');
            $冷静->string('subject');
            $冷静->text('message')->nullable();
            $冷静->string('status')->default('pending'); // pending, contacted, completed, cancelled
            $冷静->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
