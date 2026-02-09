<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('page_contents')->insert([
            [
                'page' => 'corporate',
                'section' => 'banner',
                'key' => 'banner_title',
                'value' => 'Corporate Well-Being',
                'type' => 'text',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'page' => 'corporate',
                'section' => 'banner',
                'key' => 'banner_bg_image',
                'value' => 'image/footer-img.jpg',
                'type' => 'image',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('page_contents')->where('page', 'corporate')->where('section', 'banner')->delete();
    }
};
