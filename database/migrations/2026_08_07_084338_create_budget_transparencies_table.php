<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('budget_transparencies', function (Blueprint $table) {
            $table->id();
            $table->string('year');
            $table->enum('category', ['Pendapatan', 'Belanja', 'Pembiayaan']);
            $table->string('title');
            $table->decimal('amount', 15, 2);
            $table->string('pdf_file')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('budget_transparencies');
    }
};
