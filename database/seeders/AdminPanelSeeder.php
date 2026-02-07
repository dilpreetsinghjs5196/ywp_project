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
            ['page' => 'home', 'section' => 'about_us', 'key' => 'title', 'value' => 'Your Journey To Mental Wellness Starts Here', 'type' => 'text'],
            ['page' => 'home', 'section' => 'about_us', 'key' => 'experience_years', 'value' => '10+', 'type' => 'text'],
            ['page' => 'home', 'section' => 'about_us', 'key' => 'about_image_1', 'value' => 'image/about2.jpg', 'type' => 'image'],
            ['page' => 'home', 'section' => 'about_us', 'key' => 'about_image_2', 'value' => 'image/about1.jpg', 'type' => 'image'],
        ];

        foreach ($homeContent as $content) {
            \App\Models\PageContent::updateOrCreate(
                ['page' => $content['page'], 'section' => $content['section'], 'key' => $content['key']],
                $content
            );
        }
    }
}
