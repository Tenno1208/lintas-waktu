<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('memories', function (Blueprint $table) {
            $table->id();
            $table->string('title'); 
            $table->string('category'); // adventure, school, graduation
            $table->date('event_date'); 
            $table->text('story')->nullable(); 
            $table->string('location')->nullable(); 
            $table->json('photos'); // Menyimpan array path foto
            $table->integer('height_mdpl')->nullable(); // Khusus kategori gunung
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('memories');
    }
};