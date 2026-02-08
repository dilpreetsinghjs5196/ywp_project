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
        PageContent::where('page', 'about')
            ->whereIn('section', ['banner', 'hero', 'consult', 'steps'])
            ->delete();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No easy way to restore deleted records without knowing exactly what they were.
    }
};
