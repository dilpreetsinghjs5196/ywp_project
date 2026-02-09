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
        DB::table('page_contents')->insert([
            [
                'page' => 'corporate',
                'section' => 'hero',
                'key' => 'title',
                'value' => 'Healthy employees are a key to <span class="text-secondary-color">Success</span>',
                'type' => 'text',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'page' => 'corporate',
                'section' => 'hero',
                'key' => 'description',
                'value' => 'We provide organisations with an easy access to therapy sessions, webinars, self-care tools, a community and an end to end professional support. Thus, taking care of people who take care of your business.',
                'type' => 'textarea',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'page' => 'corporate',
                'section' => 'hero',
                'key' => 'image',
                'value' => 'image/about1.jpg',
                'type' => 'image',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'page' => 'corporate',
                'section' => 'hero',
                'key' => 'bg_image',
                'value' => 'image/Homehero.png',
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
        //
    }
};
