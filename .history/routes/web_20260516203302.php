<?php

use App\Models\Mountain;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // Mengambil semua data gunung dari database
    $mountains = Mountain::latest()->get();

    // Mengirim variabel $mountains ke view welcome.blade.php
    return view('welcome', compact('mountains'));
});

Siap! Ini adalah kode final, lengkap, dan terintegrasi untuk proyek Jurnal Lintas Waktu kamu ("Chapters"). Semua komponen sudah dipisah, mendukung multi-kategori (Gunung, Sekolah, Wisuda), responsif, dan menggunakan desain Minimalist Dark Aesthetic.

1. Struktur Database (database/migrations/xxxx_create_memories_table.php)
Jalankan php artisan make:model Memory -m lalu isi file migration-nya dengan kode ini:

PHP
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
Jangan lupa jalankan php artisan migrate dan php artisan storage:link di terminal.

2. Model (app/Models/Memory.php)
PHP
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Memory extends Model
{
    protected $fillable = [
        'title', 'category', 'event_date', 'story', 'location', 'photos', 'height_mdpl'
    ];

    protected $casts = [
        'photos' => 'array',
        'event_date' => 'date'
    ];
}

use App\Models\Memory;

Route::get('/', function () {
    // Mengambil data memori terbaru
    $memories = Memory::latest('event_date')->get();
    return view('welcome', compact('memories'));
});
