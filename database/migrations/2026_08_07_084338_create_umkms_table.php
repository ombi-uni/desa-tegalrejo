<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('umkms', function (Blueprint $table) {
            $table->id();
            $table->string('store_name');
            $table->string('owner_name');
            $table->string('category')->default('Kuliner');
            $table->string('product_name');
            $table->text('description');
            $table->string('price_range')->nullable();
            $table->string('whatsapp_number');
            $table->text('google_maps_url')->nullable();
            $table->string('shopee_url')->nullable();
            $table->string('tokopedia_url')->nullable();
            $table->boolean('has_nib')->default(false);
            $table->boolean('has_pirt')->default(false);
            $table->boolean('has_halal')->default(false);
            $table->string('image')->nullable();
            $table->boolean('is_featured')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('umkms');
    }
};
