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
        // First clean up old workshop entries
        DB::table('page_contents')->where('page', 'corporate')->where('section', 'workshops')->delete();

        $workshops = [
            [
                'title' => 'Sound based healing',
                'description' => 'At Bajaj Auto Waluj, we delivered an immersive, two-day sound therapy experience that blended the psychology of sound with lived emotional wellness. Through guided sessions on frequency, vibration, and mindful listening, employees discovered how sound can regulate stress, restore focus, and elevate mental well-being — turning the workplace into a space of calm, connection, and collective energy.',
                'image_1' => 'image/wonder-store/BM1.jpg',
                'image_2' => 'image/wonder-store/S1.jpg',
                'icon' => 'bi-volume-up-fill',
            ],
            [
                'title' => 'Workplace Psychological Safety through art therapy',
                'description' => 'High-impact mental health initiatives designed to strengthen empathy, reduce stigma, and embed psychological safety across the workforce. Through interactive sessions and Expressive Art Therapy, employees engaged in open conversations on mental health and addiction — fostering trust, connection, and a more supportive work environment.',
                'image_1' => 'image/wonder-store/BM2.jpg',
                'image_2' => 'image/wonder-store/S2.jpg',
                'icon' => 'bi-palette-fill',
            ],
            [
                'title' => 'Mindful Tech Culture',
                'description' => 'Addressed the realities of corporate burnout, digital overload, social media fatigue, and growing AI dependency. Through expert-led discussions, lived-experience storytelling, and interactive art-based activities, employees reflected on their relationship with technology, learned practical strategies to set boundaries, and built healthier, more sustainable work habits — fostering focus, resilience, and overall well-being in the workplace.',
                'image_1' => 'image/wonder-store/BM3.jpg',
                'image_2' => 'image/wonder-store/S3.jpg',
                'icon' => 'bi-laptop',
            ],
            [
                'title' => 'Substance Use Awareness',
                'description' => 'Facilitated focused sessions addressing alcohol use and its impact on mental health, safety, and workplace performance. Through open conversations, expert guidance, and stigma-free dialogue, employees explored early warning signs, coping alternatives, and pathways to support — fostering awareness, responsibility, and a healthier work environment.',
                'image_1' => 'image/wonder-store/BM4.jpg',
                'image_2' => 'image/wonder-store/S4.jpg',
                'icon' => 'bi-exclamation-triangle-fill',
            ],
            [
                'title' => 'Gender Equity at workplace through street theatre',
                'description' => 'Through an engaging street theatre performance (Nukkad Natak), we brought to life the experiences of women from diverse backgrounds navigating barriers, biases, and societal expectations. The interactive format encouraged reflection, dialogue, and allyship — fostering greater gender sensitivity and a more inclusive workplace culture.',
                'image_1' => 'image/wonder-store/BM5.jpg',
                'image_2' => 'image/wonder-store/S5.jpg',
                'icon' => 'bi-people-fill',
            ],
            [
                'title' => 'Stress Management',
                'description' => 'Building calmer, more resilient teams through interactive stress management workshops that helped employees understand the psychology of stress and its impact on performance, health, and daily functioning. Through breathwork, mindfulness practices, and guided group activities, participants learned practical tools to regulate stress, improve focus, and maintain healthier work–life balance — fostering resilience and overall well-being at work.',
                'image_1' => 'image/wonder-store/BM7.jpg',
                'image_2' => 'image/wonder-store/S6.jpg',
                'icon' => 'bi-wind',
            ],
            [
                'title' => 'Everyday Wellbeing',
                'description' => 'Workshop combined psychoeducation with experiential activities to help teams identify stress triggers, slow down, and build healthier coping habits. From group discussions to calming creative exercises, employees connected, reflected, and strengthened their approach to managing pressure at work.',
                'image_1' => 'image/wonder-store/BM8.jpg',
                'image_2' => 'image/wonder-store/S7.jpg',
                'icon' => 'bi-sun-fill',
            ],
            [
                'title' => 'Organizational Well-being Strategy',
                'description' => 'Conducted a comprehensive mental health and workplace well-being diagnostic across departments including HR, Legal, Admin, and Sales. By assessing employee experiences and organizational practices, we identified key gaps in managerial support, work–life balance, and growth opportunities. The insights were translated into a focused, actionable report that equipped leadership to make informed decisions and build a healthier, more productive, and collaborative workplace.',
                'image_1' => 'image/wonder-store/pur1.png',
                'image_2' => 'image/wonder-store/pur2.png',
                'icon' => 'bi-graph-up-arrow',
            ]
        ];

        $data = [];
        foreach ($workshops as $index => $w) {
            $num = $index + 1;
            $data[] = [
                'page' => 'corporate',
                'section' => 'workshops',
                'key' => "workshop_{$num}_title",
                'value' => $w['title'],
                'type' => 'text',
                'created_at' => now(),
                'updated_at' => now(),
            ];
            $data[] = [
                'page' => 'corporate',
                'section' => 'workshops',
                'key' => "workshop_{$num}_description",
                'value' => $w['description'],
                'type' => 'textarea',
                'created_at' => now(),
                'updated_at' => now(),
            ];
            $data[] = [
                'page' => 'corporate',
                'section' => 'workshops',
                'key' => "workshop_{$num}_image_1",
                'value' => $w['image_1'],
                'type' => 'image',
                'created_at' => now(),
                'updated_at' => now(),
            ];
            $data[] = [
                'page' => 'corporate',
                'section' => 'workshops',
                'key' => "workshop_{$num}_image_2",
                'value' => $w['image_2'],
                'type' => 'image',
                'created_at' => now(),
                'updated_at' => now(),
            ];
            $data[] = [
                'page' => 'corporate',
                'section' => 'workshops',
                'key' => "workshop_{$num}_icon",
                'value' => $w['icon'],
                'type' => 'text',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('page_contents')->insert($data);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
