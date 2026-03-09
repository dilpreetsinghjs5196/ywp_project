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
        Schema::table('blog_videos', function (Blueprint $table) {
            $table->dropForeign(['blog_theme_id']);
            $table->dropColumn('blog_theme_id');
            $table->foreignId('video_theme_id')->after('id')->constrained()->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('blog_videos', function (Blueprint $table) {
            $table->dropForeign(['video_theme_id']);
            $table->dropColumn('video_theme_id');
            $table->foreignId('blog_theme_id')->after('id')->constrained()->onDelete('cascade');
        });
    }
};
