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
                'section' => 'appointment',
                'key' => 'small_heading',
                'value' => 'WHATEVER IT TAKES',
                'type' => 'text',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'page' => 'corporate',
                'section' => 'appointment',
                'key' => 'title',
                'value' => 'Empowering Minds, One Organization At A Time',
                'type' => 'text',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'page' => 'corporate',
                'section' => 'appointment',
                'key' => 'description',
                'value' => 'We help businesses create a culture of mental wellness, productivity, and resilience through tailored support systems.',
                'type' => 'textarea',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'page' => 'corporate',
                'section' => 'appointment',
                'key' => 'list_item_1',
                'value' => 'Corporate Therapy Sessions',
                'type' => 'text',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'page' => 'corporate',
                'section' => 'appointment',
                'key' => 'list_item_2',
                'value' => 'Employee Wellness Workshops',
                'type' => 'text',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'page' => 'corporate',
                'section' => 'appointment',
                'key' => 'list_item_3',
                'value' => '24/7 Professional Support',
                'type' => 'text',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'page' => 'corporate',
                'section' => 'appointment',
                'key' => 'main_image',
                'value' => 'image/choose.jpg',
                'type' => 'image',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'page' => 'corporate',
                'section' => 'appointment',
                'key' => 'stat_1_number',
                'value' => '500+',
                'type' => 'text',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'page' => 'corporate',
                'section' => 'appointment',
                'key' => 'stat_1_text',
                'value' => 'Corporate Clients',
                'type' => 'text',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'page' => 'corporate',
                'section' => 'appointment',
                'key' => 'stat_2_number',
                'value' => '98%',
                'type' => 'text',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'page' => 'corporate',
                'section' => 'appointment',
                'key' => 'stat_2_text',
                'value' => 'Satisfaction Rate',
                'type' => 'text',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'page' => 'corporate',
                'section' => 'appointment',
                'key' => 'stat_3_number',
                'value' => '50+',
                'type' => 'text',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'page' => 'corporate',
                'section' => 'appointment',
                'key' => 'stat_3_text',
                'value' => 'Expert Partners',
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
        DB::table('page_contents')->where('page', 'corporate')->where('section', 'appointment')->delete();
    }
};
