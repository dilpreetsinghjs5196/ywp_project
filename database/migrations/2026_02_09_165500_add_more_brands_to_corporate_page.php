<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $brands = [];
        for ($i = 1; $i <= 12; $i++) {
            $brands[] = [
                'page' => 'corporate',
                'section' => 'brands',
                'key' => "brand_{$i}_logo",
                'value' => '', // Empty value for now
                'type' => 'image',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Add a title field if it doesn't exist
        $exists = DB::table('page_contents')
            ->where('page', 'corporate')
            ->where('section', 'brands')
            ->where('key', 'brands_title')
            ->exists();

        if (!$exists) {
            array_unshift($brands, [
                'page' => 'corporate',
                'section' => 'brands',
                'key' => 'brands_title',
                'value' => 'Brands That Trust Us',
                'type' => 'text',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Use updateOrInsert to avoid duplicates if some already exist
        foreach ($brands as $brand) {
            DB::table('page_contents')->updateOrInsert(
                ['page' => $brand['page'], 'section' => $brand['section'], 'key' => $brand['key']],
                ['value' => $brand['value'], 'type' => $brand['type'], 'updated_at' => now()]
            );
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('page_contents')
            ->where('page', 'corporate')
            ->where('section', 'brands')
            ->delete();
    }
};
