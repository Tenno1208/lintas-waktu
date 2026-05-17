<?php

use App\Models\Mountain;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // Mengambil semua data gunung dari database
    $mountains = Mountain::latest()->get();

    // Mengirim variabel $mountains ke view welcome.blade.php
    return view('welcome', compact('mountains'));
});

Route::get('/', function () {
    // Mengambil data memori terbaru
    $memories = Memory::latest('event_date')->get();
    return view('welcome', compact('memories'));
});
