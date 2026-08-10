<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('umkms', function (Blueprint $table) {
            $table->string('slug')->nullable()->after('store_name');
            $table->text('address')->nullable()->after('description');
            $table->json('products_list')->nullable()->after('price_range');
            $table->json('gallery_images')->nullable()->after('image');
            $table->integer('featured_order')->default(0)->after('is_featured');
        });
    }

    public function down(): void
    {
        Schema::table('umkms', function (Blueprint $table) {
            $table->dropColumn(['slug', 'address', 'products_list', 'gallery_images', 'featured_order']);
        });
    }
};
