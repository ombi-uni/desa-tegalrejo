<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('village_profiles', function (Blueprint $table) {
            $table->string('video_title')->nullable()->default('Video Profil Desa Tegalrejo')->after('video_url');
            $table->text('video_description')->nullable()->after('video_title');
        });
    }

    public function down(): void
    {
        Schema::table('village_profiles', function (Blueprint $table) {
            $table->dropColumn(['video_title', 'video_description']);
        });
    }
};
