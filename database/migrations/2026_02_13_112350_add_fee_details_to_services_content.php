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
        $contents = [
            // Fee Items
            ['page' => 'services', 'section' => 'fees', 'key' => 'fee_1_name', 'value' => 'Individual Therapy', 'type' => 'text'],
            ['page' => 'services', 'section' => 'fees', 'key' => 'fee_1_description', 'value' => '50-minute session for one person', 'type' => 'text'],
            ['page' => 'services', 'section' => 'fees', 'key' => 'fee_1_price', 'value' => 'Γé╣ 1,200 - Γé╣ 2,500', 'type' => 'text'],

            ['page' => 'services', 'section' => 'fees', 'key' => 'fee_2_name', 'value' => 'Couples Counseling', 'type' => 'text'],
            ['page' => 'services', 'section' => 'fees', 'key' => 'fee_2_description', 'value' => '60-90 minute session for partners', 'type' => 'text'],
            ['page' => 'services', 'section' => 'fees', 'key' => 'fee_2_price', 'value' => 'Γé╣ 2,000 - Γé╣ 3,500', 'type' => 'text'],

            ['page' => 'services', 'section' => 'fees', 'key' => 'fee_3_name', 'value' => 'Group Session', 'type' => 'text'],
            ['page' => 'services', 'section' => 'fees', 'key' => 'fee_3_description', 'value' => 'Variable duration, small groups', 'type' => 'text'],
            ['page' => 'services', 'section' => 'fees', 'key' => 'fee_3_price', 'value' => 'Γé╣ 500 - Γé╣ 1,000', 'type' => 'text'],

            ['page' => 'services', 'section' => 'fees', 'key' => 'fee_info_note', 'value' => 'Fees vary depending on the specialist\'s experience and the session type. Payment can be made online at the time of booking.', 'type' => 'textarea'],
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
        PageContent::where('page', 'services')
            ->whereIn('key', ['fee_1_name', 'fee_1_description', 'fee_1_price', 'fee_2_name', 'fee_2_description', 'fee_2_price', 'fee_3_name', 'fee_3_description', 'fee_3_price', 'fee_info_note'])
            ->delete();
    }
};
