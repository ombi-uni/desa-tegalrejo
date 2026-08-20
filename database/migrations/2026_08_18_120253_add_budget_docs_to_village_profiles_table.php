<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('village_profiles', function (Blueprint $table) {
            $table->string('pendapatan_doc')->nullable()->after('budget_banner_image');
            $table->string('belanja_doc')->nullable()->after('pendapatan_doc');
            $table->string('pembiayaan_doc')->nullable()->after('belanja_doc');
        });
    }

    public function down(): void
    {
        Schema::table('village_profiles', function (Blueprint $table) {
            $table->dropColumn(['pendapatan_doc', 'belanja_doc', 'pembiayaan_doc']);
        });
    }
};
