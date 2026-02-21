<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\BlogTheme;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        // Clear existing data to avoid duplicates
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Blog::truncate();
        BlogTheme::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Theme 1: Autism Spectrum & Neurodiversity
        $theme1 = BlogTheme::create([
            'name' => 'Autism Spectrum & Neurodiversity',
            'slug' => 'autism-spectrum-neurodiversity',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        Blog::create([
            'blog_theme_id' => $theme1->id,
            'title' => 'Understanding Autism Spectrum Disorder',
            'slug' => 'understanding-asd',
            'summary' => 'A comprehensive guide to recognizing the signs and symptoms of ASD in children and adults.',
            'content' => '<h3>What is ASD?</h3><p>Autism Spectrum Disorder (ASD) is a developmental condition that involves challenges in social interaction, communication, and restricted or repetitive behaviors. The word "spectrum" reflects the wide range of symptoms and levels of impairment that individuals can experience.</p><h3>Key Signs</h3><ul><li>Difficulty with social-emotional reciprocity</li><li>Nonverbal communication challenges (e.g., eye contact)</li><li>Developing, maintaining, and understanding relationships</li><li>Stereotyped or repetitive motor movements</li></ul>',
            'is_active' => true,
            'published_at' => '2022-11-11',
        ]);

        Blog::create([
            'blog_theme_id' => $theme1->id,
            'title' => 'Effective Interventions for Autism',
            'slug' => 'interventions-for-asd',
            'summary' => 'Evidence-based therapies like ABA and Social Skills Training that help improve quality of life.',
            'content' => '<p>Interventions for ASD focus on improving social, communication, and behavioral skills. Early intervention is key to achieving the best possible outcomes.</p><h3>Applied Behavior Analysis (ABA)</h3><p>ABA focuses on reinforcing positive behaviors and teaching new skills through a structured approach.</p><h3>Social Skills Training</h3><p>Teaching children and adolescents how to interact with peers, share interests, and navigate social environments effectively.</p>',
            'is_active' => true,
            'published_at' => '2022-11-11',
        ]);

        // Theme 2: Abuse, Trauma & Domestic Violence
        $theme2 = BlogTheme::create([
            'name' => 'Abuse, Trauma & Domestic Violence',
            'slug' => 'abuse-trauma-domestic-violence',
            'is_active' => true,
            'sort_order' => 2,
        ]);

        Blog::create([
            'blog_theme_id' => $theme2->id,
            'title' => 'Gaslighting: When It’s Not All In Your Head',
            'slug' => 'gaslighting-awareness',
            'summary' => 'Identifying the subtle signs of emotional manipulation and psychological abuse.',
            'content' => '<p>Gaslighting is a form of emotional abuse where one person makes another question their own reality, perceptions, or memories. This manipulation can leave a victim feeling confused, anxious, and unable to trust themselves.</p><h3>Recognizing the Signs</h3><ul><li>You frequently second-guess yourself.</li><li>You wonder if you are "too sensitive" multiple times a day.</li><li>You often feel confused and even "crazy."</li><li>You find yourself apologizing constantly.</li></ul>',
            'is_active' => true,
            'published_at' => '2022-11-11',
        ]);

        // Theme 3: Child & Adolescent Mental Health
        $theme3 = BlogTheme::create([
            'name' => 'Child & Adolescent Mental Health',
            'slug' => 'child-adolescent-mental-health',
            'is_active' => true,
            'sort_order' => 3,
        ]);

        Blog::create([
            'blog_theme_id' => $theme3->id,
            'title' => 'The Effects of Bullying on a Child',
            'slug' => 'effects-of-bullying',
            'summary' => 'Understanding the psychological impact of bullying and how to support affected children.',
            'content' => '<p>Bullying is more than just a part of growing up; it can have lasting effects on a child\'s mental and emotional health. From anxiety and depression to academic struggles, the impact is significant.</p><h3>What Parents Can Do</h3><ul><li>Listen to your child without judgment.</li><li>Encourage them to talk about their feelings.</li><li>Work with the school to ensure a safe environment.</li><li>Focus on building your child\'s self-esteem.</li></ul>',
            'is_active' => true,
            'published_at' => '2022-11-11',
        ]);
    }
}
