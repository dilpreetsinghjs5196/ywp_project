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
            ['page' => 'services', 'section' => 'banner', 'key' => 'banner_bg_image', 'value' => 'image/footer-img.jpg', 'type' => 'image'],

            // Services Header Section
            ['page' => 'services', 'section' => 'services_head', 'key' => 'services_label', 'value' => 'WHATEVER WE DO', 'type' => 'text'],
            ['page' => 'services', 'section' => 'services_head', 'key' => 'services_title', 'value' => 'Services We Provide', 'type' => 'text'],
            ['page' => 'services', 'section' => 'services_head', 'key' => 'services_description', 'value' => 'We offer a wide range of mental health services tailored to your needs. Our professional therapists are here to support you every step of the way.', 'type' => 'textarea'],

            // Therapy Process (Consult) Section
            ['page' => 'services', 'section' => 'consult', 'key' => 'consult_label', 'value' => 'THERAPY PROCESS', 'type' => 'text'],
            ['page' => 'services', 'section' => 'consult', 'key' => 'consult_title', 'value' => 'From Intake to Follow-up Process', 'type' => 'text'],
            ['page' => 'services', 'section' => 'consult', 'key' => 'consult_description', 'value' => 'We follow a structured yet compassionate approach to ensure you receive the best care from your first session to your long-term wellness goals.', 'type' => 'textarea'],

            // Steps Section
            ['page' => 'services', 'section' => 'steps', 'key' => 'step_1_title', 'value' => 'Initial Consultation', 'type' => 'text'],
            ['page' => 'services', 'section' => 'steps', 'key' => 'step_1_description', 'value' => 'We start with a thorough intake to understand your history, current challenges, and goals for therapy.', 'type' => 'textarea'],
            ['page' => 'services', 'section' => 'steps', 'key' => 'step_2_title', 'value' => 'Therapy Sessions', 'type' => 'text'],
            ['page' => 'services', 'section' => 'steps', 'key' => 'step_2_description', 'value' => 'Regular sessions tailored to your specific needs, using evidence-based practices to help you progress.', 'type' => 'textarea'],
            ['page' => 'services', 'section' => 'steps', 'key' => 'step_3_title', 'value' => 'Follow-up & Support', 'type' => 'text'],
            ['page' => 'services', 'section' => 'steps', 'key' => 'step_3_description', 'value' => 'Ongoing assessment and support to ensure lasting change and continued mental well-being.', 'type' => 'textarea'],

            // Fees Section
            ['page' => 'services', 'section' => 'fees', 'key' => 'fees_label', 'value' => 'TRANSPARENCY', 'type' => 'text'],
            ['page' => 'services', 'section' => 'fees', 'key' => 'fees_title', 'value' => 'Therapy Fees', 'type' => 'text'],
            ['page' => 'services', 'section' => 'fees', 'key' => 'fees_description', 'value' => 'We believe in making therapy accessible and being transparent about our costs.', 'type' => 'textarea'],
            ['page' => 'services', 'section' => 'fees', 'key' => 'fees_button_text', 'value' => 'Show Fee Details', 'type' => 'text'],

            // FAQs Section
            ['page' => 'services', 'section' => 'faqs', 'key' => 'faqs_label', 'value' => 'FREQUENTLY ASKED QUESTIONS', 'type' => 'text'],
            ['page' => 'services', 'section' => 'faqs', 'key' => 'faqs_title', 'value' => 'Common Questions About Our Services', 'type' => 'text'],
            ['page' => 'services', 'section' => 'faqs', 'key' => 'faqs_description', 'value' => 'Find answers to the most common questions about how our therapy sessions work and what you can expect from our services.', 'type' => 'textarea'],
            ['page' => 'services', 'section' => 'faqs', 'key' => 'faq_1_question', 'value' => 'How long is each therapy session?', 'type' => 'text'],
            ['page' => 'services', 'section' => 'faqs', 'key' => 'faq_1_answer', 'value' => 'Standard individual therapy sessions are 50 minutes long. Couples sessions may range from 60 to 90 minutes.', 'type' => 'textarea'],
            ['page' => 'services', 'section' => 'faqs', 'key' => 'faq_2_question', 'value' => 'Are sessions conducted online or in-person?', 'type' => 'text'],
            ['page' => 'services', 'section' => 'faqs', 'key' => 'faq_2_answer', 'value' => 'We provide both online (via video call) and in-person sessions depending on your location and preference.', 'type' => 'textarea'],
            ['page' => 'services', 'section' => 'faqs', 'key' => 'faq_3_question', 'value' => 'How do I pay for the sessions?', 'type' => 'text'],
            ['page' => 'services', 'section' => 'faqs', 'key' => 'faq_3_answer', 'value' => 'Payments can be made securely through our website at the time of booking using various payment modes like UPI, Credit/Debit cards, etc.', 'type' => 'textarea'],

            // Legal Section
            ['page' => 'services', 'section' => 'legal', 'key' => 'disclaimer_title', 'value' => 'Disclaimer', 'type' => 'text'],
            ['page' => 'services', 'section' => 'legal', 'key' => 'disclaimer_text', 'value' => 'The information provided on this website is for general educational purposes only and is not a substitute for professional mental health advice, diagnosis, or treatment. Always seek the advice of your physician or other qualified health provider with any questions you may have regarding a medical or mental health condition.', 'type' => 'textarea'],
            ['page' => 'services', 'section' => 'legal', 'key' => 'privacy_title', 'value' => 'Privacy Note', 'type' => 'text'],
            ['page' => 'services', 'section' => 'legal', 'key' => 'privacy_text', 'value' => 'Your privacy is our priority. All conversations and records are strictly confidential. We adhere to the highest standards of data protection and ethical guidelines to ensure your information remains secure and private at all times.', 'type' => 'textarea'],
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
        PageContent::where('page', 'services')->delete();
    }
};
