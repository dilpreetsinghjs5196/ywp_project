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
        $workshops = [
            [
                'title' => 'Sound based healing',
                'description' => 'At Bajaj Auto Waluj, we delivered an immersive, two-day sound therapy experience that blended the psychology of sound with lived emotional wellness.',
                'image' => 'image/wonder-store/pur1.png',
                'icon' => 'bi-volume-up-fill',
            ],
            [
                'title' => 'Workplace Psychological Safety',
                'description' => 'High-impact mental health initiatives designed to strengthen empathy, reduce stigma, and embed psychological safety across the workforce.',
                'image' => 'image/wonder-store/pur2.png',
                'icon' => 'bi-shield-lock-fill',
            ],
            [
                'title' => 'Mindful Tech Culture',
                'description' => 'Addressed the realities of corporate burnout, digital overload, social media fatigue, and growing AI dependency.',
                'image' => 'image/wonder-store/BM1.jpg',
                'icon' => 'bi-laptop',
            ],
            [
                'title' => 'Substance Use Awareness',
                'description' => 'Facilitated focused sessions addressing alcohol use and its impact on mental health, safety, and workplace performance.',
                'image' => 'image/wonder-store/BM2.jpg',
                'icon' => 'bi-exclamation-triangle-fill',
            ],
            [
                'title' => 'Gender Equity',
                'description' => 'Through an engaging street theatre performance (Nukkad Natak), we brought to life the experiences of women from diverse backgrounds.',
                'image' => 'image/wonder-store/BM3.jpg',
                'icon' => 'bi-people-fill',
            ],
            [
                'title' => 'Stress Management',
                'description' => 'Building calmer, more resilient teams through interactive stress management workshops that helped employees understand the psychology of stress.',
                'image' => 'image/wonder-store/BM4.jpg',
                'icon' => 'bi-heart-pulse-fill',
            ],
            [
                'title' => 'Everyday Wellbeing',
                'description' => 'Workshop combined psychoeducation with experiential activities to help teams identify stress triggers, slow down, and build healthier coping habits.',
                'image' => 'image/wonder-store/BM5.jpg',
                'icon' => 'bi-sun-fill',
            ],
            [
                'title' => 'Organizational Well-being',
                'description' => 'Conducted a comprehensive mental health and workplace well-being diagnostic across departments like HR, Legal, Admin, and Sales.',
                'image' => 'image/wonder-store/BM7.jpg',
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
                'key' => "workshop_{$num}_image",
                'value' => $w['image'],
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
