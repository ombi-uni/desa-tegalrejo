<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('umkms', function (Blueprint $table) {
            $table->boolean('has_bpom')->default(false)->after('has_halal');
            $table->unsignedBigInteger('price_min')->nullable()->after('description');
            $table->unsignedBigInteger('price_max')->nullable()->after('price_min');
        });
    }

    public function down(): void
    {
        Schema::table('umkms', function (Blueprint $table) {
            $table->dropColumn(['has_bpom', 'price_min', 'price_max']);
        });
    }
};
