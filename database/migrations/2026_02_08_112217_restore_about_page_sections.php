<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\PageContent;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $contents = [
            // Banner Section
            ['page' => 'about', 'section' => 'banner', 'key' => 'banner_bg_image', 'value' => 'image/footer-img.jpg', 'type' => 'image'],
            ['page' => 'about', 'section' => 'banner', 'key' => 'banner_title', 'value' => 'About Us', 'type' => 'text'],

            // Consult Section
            ['page' => 'about', 'section' => 'consult', 'key' => 'consult_label', 'value' => 'HOW WE WORK ?', 'type' => 'text'],
            ['page' => 'about', 'section' => 'consult', 'key' => 'consult_title', 'value' => 'Here For Your Health, Here For Your Heart', 'type' => 'text'],
            ['page' => 'about', 'section' => 'consult', 'key' => 'consult_description', 'value' => 'We offer compassionate care, combining physical and emotional support to help you thrive in every aspect.', 'type' => 'textarea'],
            ['page' => 'about', 'section' => 'consult', 'key' => 'consult_button_text', 'value' => 'Get Consult Now', 'type' => 'text'],

            // Steps Section
            ['page' => 'about', 'section' => 'steps', 'key' => 'step_1_title', 'value' => 'Listen & Understand', 'type' => 'text'],
            ['page' => 'about', 'section' => 'steps', 'key' => 'step_1_description', 'value' => 'Your wellness journey matters. We’re dedicated to supporting both your mental clarity and emotional strength every step forward.', 'type' => 'textarea'],
            ['page' => 'about', 'section' => 'steps', 'key' => 'step_2_title', 'value' => 'Create A Tailored Plan', 'type' => 'text'],
            ['page' => 'about', 'section' => 'steps', 'key' => 'step_2_description', 'value' => 'From everyday stress to life’s hardest moments, our team stands ready to support your healing and overall well-being.', 'type' => 'textarea'],
            ['page' => 'about', 'section' => 'steps', 'key' => 'step_3_title', 'value' => 'Support & Empower', 'type' => 'text'],
            ['page' => 'about', 'section' => 'steps', 'key' => 'step_3_description', 'value' => 'Empowering you to live well with care that nurtures your body, mind, and emotional peace every single day.', 'type' => 'textarea'],
        ];

        foreach ($contents as $content) {
            PageContent::updateOrCreate(
                ['page' => $content['page'], 'section' => $content['section'], 'key' => $content['key']],
                ['value' => $content['value'], 'type' => $content['type']]
            );
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        PageContent::where('page', 'about')
            ->whereIn('section', ['banner', 'consult', 'steps'])
            ->delete();
    }
};
