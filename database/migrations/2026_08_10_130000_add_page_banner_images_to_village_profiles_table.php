<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('village_profiles', function (Blueprint $table) {
            $table->string('profile_banner_image')->nullable()->after('video_description');
            $table->string('news_banner_image')->nullable()->after('profile_banner_image');
            $table->string('umkm_banner_image')->nullable()->after('news_banner_image');
            $table->string('budget_banner_image')->nullable()->after('umkm_banner_image');
        });
    }

    public function down(): void
    {
        Schema::table('village_profiles', function (Blueprint $table) {
            $table->dropColumn([
                'profile_banner_image',
                'news_banner_image',
                'umkm_banner_image',
                'budget_banner_image',
            ]);
        });
    }
};
