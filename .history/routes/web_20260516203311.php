<?php

use App\Models\Mountain;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // Mengambil semua data gunung dari database
    $mountains = Mountain::latest()->get();

    // Mengirim variabel $mountains ke view welcome.blade.php
    return view('welcome', compact('mountains'));
});


