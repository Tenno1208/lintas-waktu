<?php

use App\Http\Controllers\AdminController;
use App\Models\Memory;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

// Halaman Depan / Utama
Route::get('/', function () {
    $memories = Memory::latest('event_date')->get();
    return view('welcome', compact('memories'));
});

// Dashboard Admin (Menggunakan Fungsi Callback Group untuk Autentikasi)
Route::prefix('admin')->group(function () {
    
    // Kita buat logic pengaman di dalam fungsi boot/middleware group scope
    $authTrashHold = function (Request $request, $next) {
        $adminUser = env('ADMIN_USER', 'admin');
        $adminPassword = env('ADMIN_PASSWORD', 'password');

        if ($request->getUser() != $adminUser || $request->getPassword() != $adminPassword) {
            return response('Akses Ditolak. Memerlukan Autentikasi Lintas Waktu.', 401, [
                'WWW-Authenticate' => 'Basic realm="Admin Lintas Waktu"'
            ]);
        }
        return $next($request);
    };

    // Terapkan pengaman ke masing-masing route di dalam admin panel
    Route::get('/', [AdminController::class, 'index'])->name('admin.index')->middleware($authTrashHold);
    Route::get('/create', [AdminController::class, 'create'])->name('admin.create')->middleware($authTrashHold);
    Route::post('/store', [AdminController::class, 'store'])->name('admin.store')->middleware($authTrashHold);
    Route::delete('/{memory}', [AdminController::class, 'destroy'])->name('admin.destroy')->middleware($authTrashHold);
});