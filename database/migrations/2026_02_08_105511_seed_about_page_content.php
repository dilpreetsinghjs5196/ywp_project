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

            // About Section
            ['page' => 'about', 'section' => 'about', 'key' => 'about_image', 'value' => 'image/about-page.jpg', 'type' => 'image'],
            ['page' => 'about', 'section' => 'about', 'key' => 'about_label', 'value' => 'ABOUT US', 'type' => 'text'],
            ['page' => 'about', 'section' => 'about', 'key' => 'about_title', 'value' => 'Because Your Mental Health Matters', 'type' => 'text'],
            ['page' => 'about', 'section' => 'about', 'key' => 'about_point_1', 'value' => 'Prioritizing well-being helps you thrive emotionally, socially, and personally every day.', 'type' => 'textarea'],
            ['page' => 'about', 'section' => 'about', 'key' => 'about_point_2', 'value' => 'Strong minds build strong lives; support and care create lasting peace.', 'type' => 'textarea'],
            ['page' => 'about', 'section' => 'about', 'key' => 'about_point_3', 'value' => 'Inner peace starts with awareness, acceptance, and support when it\'s needed most.', 'type' => 'textarea'],
            ['page' => 'about', 'section' => 'about', 'key' => 'about_point_4', 'value' => 'Emotional strength shapes how we live, connect, and move forward confidently.', 'type' => 'textarea'],
            ['page' => 'about', 'section' => 'about', 'key' => 'about_card_title', 'value' => 'Together, We overcome', 'type' => 'text'],
            ['page' => 'about', 'section' => 'about', 'key' => 'about_card_item_1', 'value' => 'Free Consultation', 'type' => 'text'],
            ['page' => 'about', 'section' => 'about', 'key' => 'about_card_item_2', 'value' => 'Mental Satisfaction', 'type' => 'text'],
            ['page' => 'about', 'section' => 'about', 'key' => 'about_card_item_3', 'value' => 'Emergency Service', 'type' => 'text'],

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

            // Specialist Section
            ['page' => 'about', 'section' => 'specialists', 'key' => 'specialists_label', 'value' => 'OUR SPECIALIST', 'type' => 'text'],
            ['page' => 'about', 'section' => 'specialists', 'key' => 'specialists_title', 'value' => 'Meet Our Senior Therapist', 'type' => 'text'],

            // FAQs Section
            ['page' => 'about', 'section' => 'faqs', 'key' => 'faqs_label', 'value' => 'FREQUENTLY ASKED QUESTION', 'type' => 'text'],
            ['page' => 'about', 'section' => 'faqs', 'key' => 'faqs_title', 'value' => 'The Most Question We Got So Far', 'type' => 'text'],
            ['page' => 'about', 'section' => 'faqs', 'key' => 'faqs_rating', 'value' => '4,9 /5', 'type' => 'text'],
            ['page' => 'about', 'section' => 'faqs', 'key' => 'faqs_description', 'value' => 'Through consistent care and compassionate guidance, we help individuals rediscover strength, build resilience, and move forward toward a brighter, healthier future at their own pace.', 'type' => 'textarea'],
            ['page' => 'about', 'section' => 'faqs', 'key' => 'faq_1_question', 'value' => 'What is mental health, and why is it important?', 'type' => 'text'],
            ['page' => 'about', 'section' => 'faqs', 'key' => 'faq_1_answer', 'value' => 'If you experience persistent feelings of sadness, anxiety, or stress that interfere with daily life, it may be time to seek professional support. Other signs include difficulty concentrating, changes in sleep patterns, or feelings of isolation and hopelessness.', 'type' => 'textarea'],
            ['page' => 'about', 'section' => 'faqs', 'key' => 'faq_2_question', 'value' => 'How can I tell if I need professional mental health support?', 'type' => 'text'],
            ['page' => 'about', 'section' => 'faqs', 'key' => 'faq_2_answer', 'value' => 'Mental health refers to a person’s emotional, psychological, and social well-being. It affects how people think, feel, and behave. Maintaining good mental health is essential for handling stress, building relationships, and making decisions in daily life.', 'type' => 'textarea'],
            ['page' => 'about', 'section' => 'faqs', 'key' => 'faq_3_question', 'value' => 'Are online therapy sessions effective?', 'type' => 'text'],
            ['page' => 'about', 'section' => 'faqs', 'key' => 'faq_3_answer', 'value' => 'Yes, online therapy can be very effective for many individuals. It offers flexibility, accessibility, and privacy, making it easier for people to access professional help from the comfort of their own homes.', 'type' => 'textarea'],
            ['page' => 'about', 'section' => 'faqs', 'key' => 'faq_4_question', 'value' => 'What can I do to improve my mental well-being daily?', 'type' => 'text'],
            ['page' => 'about', 'section' => 'faqs', 'key' => 'faq_4_answer', 'value' => 'You can improve your mental well-being by practicing self-care, such as regular exercise, a healthy diet, mindfulness, and getting enough sleep. Additionally, staying connected with loved ones and seeking help when needed are essential steps toward better mental health.', 'type' => 'textarea'],
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
        PageContent::where('page', 'about')->delete();
    }
};
