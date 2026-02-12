<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\SiteSetting;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $setting = SiteSetting::where('key', 'workplace_email')->first();

        if ($setting) {
            $setting->update([
                'value' => 'dilpreetsingh5196@gmail.com',
                'group' => 'contact', // Ensure it shows up in Contact Settings
            ]);
        } else {
            SiteSetting::create([
                'key' => 'workplace_email',
                'value' => 'dilpreetsingh5196@gmail.com',
                'group' => 'contact',
                'type' => 'text',
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No need to revert specifically for this task as it's adding data
    }
};
