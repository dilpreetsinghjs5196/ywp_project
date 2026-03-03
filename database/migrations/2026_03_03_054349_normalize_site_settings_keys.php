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
        \App\Models\SiteSetting::where('key', 'workplace_email (Admin)')->update(['key' => 'workplace_email']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        \App\Models\SiteSetting::where('key', 'workplace_email')->update(['key' => 'workplace_email (Admin)']);
    }
};
