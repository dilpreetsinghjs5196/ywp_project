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
        $contents = [
            // Banner Section
            ['page' => 'team', 'section' => 'banner', 'key' => 'title', 'value' => 'Our Team', 'type' => 'text'],
            ['page' => 'team', 'section' => 'banner', 'key' => 'bg_image', 'value' => 'image/footer-img.jpg', 'type' => 'image'],

            // Booking Steps Section
            ['page' => 'team', 'section' => 'booking_steps', 'key' => 'label', 'value' => 'BOOKING PROCESS', 'type' => 'text'],
            ['page' => 'team', 'section' => 'booking_steps', 'key' => 'title', 'value' => 'How to Book Your Therapist', 'type' => 'text'],
            ['page' => 'team', 'section' => 'booking_steps', 'key' => 'description', 'value' => 'Select your preferred therapist, choose a convenient time slot, and confirm your appointment in just a few clicks.', 'type' => 'textarea'],
            ['page' => 'team', 'section' => 'booking_steps', 'key' => 'step_1_title', 'value' => 'Choose a Therapist', 'type' => 'text'],
            ['page' => 'team', 'section' => 'booking_steps', 'key' => 'step_1_description', 'value' => 'Browse our team and select the professional that best fits your needs.', 'type' => 'textarea'],
            ['page' => 'team', 'section' => 'booking_steps', 'key' => 'step_2_title', 'value' => 'Pick a Time Slot', 'type' => 'text'],
            ['page' => 'team', 'section' => 'booking_steps', 'key' => 'step_2_description', 'value' => 'Check their availability and choose a date and time that works for you.', 'type' => 'textarea'],
            ['page' => 'team', 'section' => 'booking_steps', 'key' => 'step_3_title', 'value' => 'Confirm & Pay', 'type' => 'text'],
            ['page' => 'team', 'section' => 'booking_steps', 'key' => 'step_3_description', 'value' => 'Provide your details and complete the secure payment to finalize your booking.', 'type' => 'textarea'],

            // FAQ Section
            ['page' => 'team', 'section' => 'faqs', 'key' => 'title', 'value' => 'Frequently Asked Questions', 'type' => 'text'],
            ['page' => 'team', 'section' => 'faqs', 'key' => 'faq_1_question', 'value' => 'What if I need to cancel my appointment?', 'type' => 'text'],
            ['page' => 'team', 'section' => 'faqs', 'key' => 'faq_1_answer', 'value' => 'You can cancel or reschedule up to 24 hours before your session directly through your profile.', 'type' => 'textarea'],
            ['page' => 'team', 'section' => 'faqs', 'key' => 'faq_2_question', 'value' => 'Are the sessions confidential?', 'type' => 'text'],
            ['page' => 'team', 'section' => 'faqs', 'key' => 'faq_2_answer', 'value' => 'Yes, all sessions are strictly confidential between you and your therapist.', 'type' => 'textarea'],

            // Disclaimer Section
            ['page' => 'team', 'section' => 'disclaimer', 'key' => 'title', 'value' => 'Disclaimer', 'type' => 'text'],
            ['page' => 'team', 'section' => 'disclaimer', 'key' => 'content', 'value' => 'Our therapists are registered professionals. However, this service is not for emergency psychiatric crises.', 'type' => 'textarea'],
        ];

        foreach ($contents as $content) {
            \App\Models\PageContent::updateOrCreate(
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
        \App\Models\PageContent::where('page', 'team')->delete();
    }
};
