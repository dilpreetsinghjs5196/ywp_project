<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminPanelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Global Site Settings (Branding)
        $settings = [
            ['key' => 'site_logo', 'value' => 'image/white-logo.png', 'group' => 'branding', 'type' => 'image'],
            ['key' => 'site_logo_black', 'value' => 'image/black-logo.png', 'group' => 'branding', 'type' => 'image'],
            ['key' => 'primary_color', 'value' => '#044A80', 'group' => 'branding', 'type' => 'color'],
            ['key' => 'secondary_color', 'value' => '#ffbf00', 'group' => 'branding', 'type' => 'color'],

            // Contact & Footer
            ['key' => 'contact_email', 'value' => 'info@yourewonderfulproject.com', 'group' => 'contact', 'type' => 'text'],
            ['key' => 'contact_phone', 'value' => '(555) 123-4567', 'group' => 'contact', 'type' => 'text'],
            ['key' => 'office_address', 'value' => '123 Serenity Lane, Blissfield, CA 90210', 'group' => 'contact', 'type' => 'text'],
            ['key' => 'footer_about', 'value' => 'Professional, responsive, and soothing design for therapists, counselors, and life coaches.', 'group' => 'footer', 'type' => 'textarea'],
        ];

        foreach ($settings as $setting) {
            \App\Models\SiteSetting::updateOrCreate(['key' => $setting['key']], $setting);
        }

        // Home Page Content
        $homeContent = [
            // Hero Section
            ['page' => 'home', 'section' => 'hero', 'key' => 'main_title', 'value' => 'Caring for Your Inner Peace', 'type' => 'text'],
            ['page' => 'home', 'section' => 'hero', 'key' => 'subtitle', 'value' => 'Discover clarity, confidence, and emotional wellness through guided support.', 'type' => 'textarea'],
            ['page' => 'home', 'section' => 'hero', 'key' => 'hero_image', 'value' => 'image/hero-img.png', 'type' => 'image'],
            ['page' => 'home', 'section' => 'hero', 'key' => 'hero_bg_image', 'value' => 'image/Homehero.png', 'type' => 'image'],
            ['page' => 'home', 'section' => 'hero', 'key' => 'hero_overlay_color', 'value' => '#044A80', 'type' => 'color'],
            ['page' => 'home', 'section' => 'hero', 'key' => 'hero_overlay_opacity', 'value' => '0.7', 'type' => 'text'],
            ['page' => 'home', 'section' => 'hero', 'key' => 'hero_show_overlay', 'value' => 'yes', 'type' => 'text'],

            // About Section on Home
            ['page' => 'home', 'section' => 'about_us', 'key' => 'small_heading', 'value' => 'ABOUT US', 'type' => 'text'],
            ['page' => 'home', 'section' => 'about_us', 'key' => 'title', 'value' => 'Your Journey To Mental Wellness Starts Here', 'type' => 'text'],
            ['page' => 'home', 'section' => 'about_us', 'key' => 'description', 'value' => 'Every small step toward better mental health is a significant achievement in our lives. With the right support, each individual can find the strength to face challenges, manage stress, and build positive habits. We believe that everyone deserves the opportunity to grow, thrive, and experience inner peace. Through an empathetic and professional approach, we are here to help you discover the best solutions for lasting mental and emotional well-being.', 'type' => 'textarea'],
            ['page' => 'home', 'section' => 'about_us', 'key' => 'list_item_1', 'value' => 'Free Consultation', 'type' => 'text'],
            ['page' => 'home', 'section' => 'about_us', 'key' => 'list_item_2', 'value' => 'Emergency Service', 'type' => 'text'],
            ['page' => 'home', 'section' => 'about_us', 'key' => 'list_item_3', 'value' => 'Mental Satisfaction', 'type' => 'text'],
            ['page' => 'home', 'section' => 'about_us', 'key' => 'list_item_4', 'value' => 'Psychologists Services', 'type' => 'text'],
            ['page' => 'home', 'section' => 'about_us', 'key' => 'quote', 'value' => 'Healing doesn’t mean the damage never existed; it means the strength to rise is greater than the pain', 'type' => 'textarea'],
            ['page' => 'home', 'section' => 'about_us', 'key' => 'experience_years', 'value' => '10+', 'type' => 'text'],
            ['page' => 'home', 'section' => 'about_us', 'key' => 'about_image_1', 'value' => 'image/about2.jpg', 'type' => 'image'],
            ['page' => 'home', 'section' => 'about_us', 'key' => 'about_image_2', 'value' => 'image/about1.jpg', 'type' => 'image'],
            ['page' => 'home', 'section' => 'about_us', 'key' => 'signature_image', 'value' => 'image/Signature.png', 'type' => 'image'],

            // Appointment / Why Choose Us Section
            ['page' => 'home', 'section' => 'appointment', 'key' => 'small_heading', 'value' => 'Why Choose Us ?', 'type' => 'text'],
            ['page' => 'home', 'section' => 'appointment', 'key' => 'title', 'value' => 'Restoring Hope, One Day At A Time', 'type' => 'text'],
            ['page' => 'home', 'section' => 'appointment', 'key' => 'description', 'value' => 'Through consistent care and compassionate guidance, we help individuals rediscover strength, build resilience, and move forward toward a brighter, healthier future at their own pace.', 'type' => 'textarea'],
            ['page' => 'home', 'section' => 'appointment', 'key' => 'list_item_1', 'value' => 'Compassionate & Experienced Professionals', 'type' => 'text'],
            ['page' => 'home', 'section' => 'appointment', 'key' => 'list_item_2', 'value' => 'Holistic Approach To Well-Being', 'type' => 'text'],
            ['page' => 'home', 'section' => 'appointment', 'key' => 'list_item_3', 'value' => 'Safe & Supportive Environment', 'type' => 'text'],
            ['page' => 'home', 'section' => 'appointment', 'key' => 'main_image', 'value' => 'image/choose.jpg', 'type' => 'image'],
            ['page' => 'home', 'section' => 'appointment', 'key' => 'stat_1_number', 'value' => '100%', 'type' => 'text'],
            ['page' => 'home', 'section' => 'appointment', 'key' => 'stat_1_text', 'value' => 'Satisfaction', 'type' => 'text'],
            ['page' => 'home', 'section' => 'appointment', 'key' => 'stat_2_number', 'value' => '257+', 'type' => 'text'],
            ['page' => 'home', 'section' => 'appointment', 'key' => 'stat_2_text', 'value' => 'Happy Patient', 'type' => 'text'],
            ['page' => 'home', 'section' => 'appointment', 'key' => 'stat_3_number', 'value' => '10+', 'type' => 'text'],
            ['page' => 'home', 'section' => 'appointment', 'key' => 'stat_3_text', 'value' => 'Expert Therapist', 'type' => 'text'],
        ];

        foreach ($homeContent as $content) {
            \App\Models\PageContent::updateOrCreate(
                ['page' => $content['page'], 'section' => $content['section'], 'key' => $content['key']],
                $content
            );
        }
    }
}
