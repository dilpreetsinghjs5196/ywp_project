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
        \App\Models\SiteSetting::updateOrCreate(
            ['key' => 'therapist_application_url'],
            [
                'value' => 'https://forms.google.com',
                'group' => 'contact',
                'type' => 'text'
            ]
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        \App\Models\SiteSetting::where('key', 'therapist_application_url')->delete();
    }
};
