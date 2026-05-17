<?php

use App\Models\Memory;
use App\Models\Mountain;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    // Mengambil data memori terbaru
    $memories = Memory::latest('event_date')->get();
    return view('welcome', compact('memories'));
});
