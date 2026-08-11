<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('statistics', function (Blueprint $table) {
            // Rincian Jenis Kelamin
            $table->integer('male_count')->default(0)->after('population_count');
            $table->integer('female_count')->default(0)->after('male_count');
            // Jumlah KK
            $table->integer('household_count')->default(0)->after('female_count');
            // Jumlah RT / RW
            $table->integer('rt_count')->default(0)->after('household_count');
            $table->integer('rw_count')->default(0)->after('rt_count');
            // Data JSON per kategori demografis
            $table->json('hamlets_data')->nullable()->after('worship_place_count');
            $table->json('religion_data')->nullable()->after('hamlets_data');
            $table->json('education_data')->nullable()->after('religion_data');
            $table->json('age_group_data')->nullable()->after('education_data');
            $table->json('occupation_data')->nullable()->after('age_group_data');
            // Catatan sumber & tanggal update data
            $table->string('last_updated_note')->nullable()->after('occupation_data');
        });
    }

    public function down(): void
    {
        Schema::table('statistics', function (Blueprint $table) {
            $table->dropColumn([
                'male_count', 'female_count', 'household_count',
                'rt_count', 'rw_count',
                'hamlets_data', 'religion_data', 'education_data',
                'age_group_data', 'occupation_data', 'last_updated_note',
            ]);
        });
    }
};
