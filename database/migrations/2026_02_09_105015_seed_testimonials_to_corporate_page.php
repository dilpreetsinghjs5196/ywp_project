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
                'section' => 'testimonials',
                'key' => 'small_heading',
                'value' => 'CLIENT FEEDBACKS',
                'type' => 'text',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'page' => 'corporate',
                'section' => 'testimonials',
                'key' => 'title',
                'value' => 'Healing Begins with a Conversation',
                'type' => 'text',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'page' => 'corporate',
                'section' => 'testimonials',
                'key' => 'description',
                'value' => 'Healing is support—not just a process. Our team walks with you every step of the way.',
                'type' => 'textarea',
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
        DB::table('page_contents')
            ->where('page', 'corporate')
            ->where('section', 'testimonials')
            ->whereIn('key', ['small_heading', 'title', 'description'])
            ->delete();
    }
};
