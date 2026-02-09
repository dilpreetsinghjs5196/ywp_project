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
                'section' => 'teams',
                'key' => 'small_heading',
                'value' => 'OUR SPECIALIST',
                'type' => 'text',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'page' => 'corporate',
                'section' => 'teams',
                'key' => 'title',
                'value' => 'Meet Our Senior<br>Therapist',
                'type' => 'text',
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
        DB::table('page_contents')->where('page', 'corporate')->where('section', 'teams')->delete();
    }
};
