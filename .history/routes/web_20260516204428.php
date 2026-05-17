<?php

use App\Models\Memory;
use App\Models\Mountain;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    // Mengambil data memori terbaru
    $memories = Memory::latest('event_date')->get();
    return view('welcome', compact('memories'));
});

Route::prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/create', [AdminController::class, 'create'])->name('admin.create');
    Route::post('/store', [AdminController::class, 'store'])->name('admin.store');
    Route::delete('/{memory}', [AdminController::class, 'destroy'])->name('admin.destroy');
});
