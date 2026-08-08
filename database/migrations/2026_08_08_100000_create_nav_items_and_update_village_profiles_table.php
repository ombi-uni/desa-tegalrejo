<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('nav_items', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('url');
            $table->foreignId('parent_id')->nullable()->constrained('nav_items')->onDelete('cascade');
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->string('target')->default('_self');
            $table->string('icon')->nullable();
            $table->string('badge')->nullable();
            $table->timestamps();
        });

        Schema::table('village_profiles', function (Blueprint $table) {
            $table->string('village_name')->default('Desa Tegalrejo')->after('id');
            $table->string('subdistrict')->default('Kec. Tengaran')->after('village_name');
            $table->string('district')->default('Kab. Semarang')->after('subdistrict');
            $table->string('logo')->nullable()->after('district');
            $table->string('logo_icon')->default('fa-solid fa-tree-city')->after('logo');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('nav_items');
        
        Schema::table('village_profiles', function (Blueprint $table) {
            $table->dropColumn(['village_name', 'subdistrict', 'district', 'logo', 'logo_icon']);
        });
    }
};
