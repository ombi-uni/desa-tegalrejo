<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('banners', function (Blueprint $table) {
            $table->string('badge_text')->nullable()->default('Portal Resmi Desa Tegalrejo')->after('title');
            $table->string('button_secondary_text')->nullable()->default('Profil & Perangkat Desa')->after('button_link');
            $table->string('button_secondary_link')->nullable()->default('/profil')->after('button_secondary_text');
        });
    }

    public function down(): void
    {
        Schema::table('banners', function (Blueprint $table) {
            $table->dropColumn(['badge_text', 'button_secondary_text', 'button_secondary_link']);
        });
    }
};
