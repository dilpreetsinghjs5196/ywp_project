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
        Schema::create('page_contents', function (Blueprint $table) {
            $table->id();
            $table->string('page'); // e.g., 'home', 'about', 'services'
            $table->string('section'); // e.g., 'hero', 'about_us', 'our_services'
            $table->string('key'); // e.g., 'title', 'subtitle', 'image', 'overlay_color'
            $table->text('value')->nullable();
            $table->string('type')->default('text'); // 'text', 'textarea', 'image', 'color'
            $table->timestamps();

            $table->unique(['page', 'section', 'key']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('page_contents');
    }
};
