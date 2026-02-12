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
        $settings = [
            ['key' => 'mail_mailer', 'value' => 'smtp', 'group' => 'smtp', 'type' => 'text'],
            ['key' => 'mail_host', 'value' => 'sandbox.smtp.mailtrap.io', 'group' => 'smtp', 'type' => 'text'],
            ['key' => 'mail_port', 'value' => '2525', 'group' => 'smtp', 'type' => 'text'],
            ['key' => 'mail_username', 'value' => '', 'group' => 'smtp', 'type' => 'text'],
            ['key' => 'mail_password', 'value' => '', 'group' => 'smtp', 'type' => 'password'],
            ['key' => 'mail_encryption', 'value' => 'tls', 'group' => 'smtp', 'type' => 'text'],
            ['key' => 'mail_from_address', 'value' => 'hello@example.com', 'group' => 'smtp', 'type' => 'text'],
            ['key' => 'mail_from_name', 'value' => 'Example App', 'group' => 'smtp', 'type' => 'text'],
        ];

        foreach ($settings as $setting) {
            \App\Models\SiteSetting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        \App\Models\SiteSetting::where('group', 'smtp')->delete();
    }
};
