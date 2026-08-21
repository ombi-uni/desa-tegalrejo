<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('news', function (Blueprint $table) {
            $table->string('dusun')->nullable()->after('id');    // tag dusun pembuat
            $table->foreignId('author_id')->nullable()->constrained('users')->nullOnDelete()->after('dusun');
        });
    }

    public function down(): void
    {
        Schema::table('news', function (Blueprint $table) {
            $table->dropForeign(['author_id']);
            $table->dropColumn(['dusun', 'author_id']);
        });
    }
};
