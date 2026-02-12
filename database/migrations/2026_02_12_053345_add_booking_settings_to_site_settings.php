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
        \DB::table('site_settings')->insert([
            [
                'key' => 'booking_address',
                'value' => '601, Naman Heights, S.V. Gurananak Road, Poddar Blocks, Bandra West, Mumbai, Maharashtra 400050',
                'group' => 'booking',
                'type' => 'textarea',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'session_duration',
                'value' => '50 mins',
                'group' => 'booking',
                'type' => 'text',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        \DB::table('site_settings')->whereIn('key', ['booking_address', 'session_duration'])->delete();
    }
};
