<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('moments', function (Blueprint $table) {
        $table->id();
        $table->string('title'); // Contoh: "Puncak Rinjani"
        $table->enum('category', ['gunung', 'sekolah', 'wisuda', 'lainnya']);
        $table->date('event_date');
        $table->string('location')->nullable();
        $table->text('description')->nullable();
        $table->string('image_path');
        $table->string('elevation')->nullable(); // Khusus kategori gunung (misal: 3726)
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('moments');
    }
};
