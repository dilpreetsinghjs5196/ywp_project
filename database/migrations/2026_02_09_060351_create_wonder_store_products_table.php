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
        Schema::create('wonder_store_products', function (Blueprint $table) {
            $table->id();
            $table->string('product_image');
            $table->foreignId('category_id')->constrained('wonder_store_categories')->onDelete('cascade');
            $table->text('product_description')->nullable();
            $table->decimal('product_price', 10, 2);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wonder_store_products');
    }
};
