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
        // Delete old keys first to avoid confusion if we re-run
        PageContent::where('page', 'about')->where('section', 'specialists')->delete();

        $contents = [
            ['page' => 'about', 'section' => 'teams', 'key' => 'small_heading', 'value' => 'OUR SPECIALIST', 'type' => 'text'],
            ['page' => 'about', 'section' => 'teams', 'key' => 'title', 'value' => 'Meet Our Senior Therapist', 'type' => 'text'],
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
        PageContent::where('page', 'about')->where('section', 'teams')->delete();
    }
};
