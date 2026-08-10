<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('banners', function (Blueprint $table) {
            $table->string('title')->nullable()->change();
            $table->text('subtitle')->nullable()->change();
            $table->string('button_text')->nullable()->change();
            $table->string('button_link')->nullable()->change();
            $table->string('badge_text')->nullable()->change();
            $table->string('button_secondary_text')->nullable()->change();
            $table->string('button_secondary_link')->nullable()->change();
        });
    }

    public function down(): void
    {
        //
    }
};
