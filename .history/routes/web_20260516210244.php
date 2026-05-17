<?php

use App\Http\Controllers\AdminController;
use App\Http\Middleware\AdminAuthMiddleware; // Panggil middleware baru di sini
use App\Models\Memory;
use Illuminate\Support\Facades\Route;

// Halaman Depan / Utama
Route::get('/', function () {
    $memories = Memory::latest('event_date')->get();
    return view('welcome', compact('memories'));
});

// Dashboard Admin (Sekarang dilindungi Class Middleware Resmi)
Route::prefix('admin')
    ->middleware(AdminAuthMiddleware::class) // Cukup panggil class-nya di sini, otomatis membungkus semua route di bawahnya
    ->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('admin.index');
        Route::get('/create', [AdminController::class, 'create'])->name('admin.create');
        Route::post('/store', [AdminController::class, 'store'])->name('admin.store');
        Route::delete('/{memory}', [AdminController::class, 'destroy'])->name('admin.destroy');
    });