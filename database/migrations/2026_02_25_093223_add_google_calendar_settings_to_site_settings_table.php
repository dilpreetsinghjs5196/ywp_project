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
        DB::table('site_settings')->insert([
            [
                'key' => 'google_client_id',
                'value' => null,
                'group' => 'google',
                'type' => 'text',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'google_client_secret',
                'value' => null,
                'group' => 'google',
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
        DB::table('site_settings')->whereIn('key', ['google_client_id', 'google_client_secret'])->delete();
    }
};
