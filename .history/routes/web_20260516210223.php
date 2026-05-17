<?php

use App\Http\Controllers\AdminController;
use App\Models\Memory;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    // Mengambil data memori terbaru
    $memories = Memory::latest('event_date')->get();
    return view('welcome', compact('memories'));
});

// Dashboard Admin (Sekarang Dilindungi Password Rahasia)
Route::prefix('admin')
    ->middleware(function ($request, $next) {
        // Ambil data dari file .env
        $adminUser = env('ADMIN_USER', 'admin');
        $adminPassword = env('ADMIN_PASSWORD', 'password');

        // Cek apakah user memasukkan username & password yang benar
        if ($request->getUser() != $adminUser || $request->getPassword() != $adminPassword) {
            // Jika salah atau belum login, minta browser memunculkan pop-up login
            return response('Akses Ditolak. Memerlukan Autentikasi Lintas Waktu.', 401, [
                'WWW-Authenticate' => 'Basic realm="Admin Lintas Waktu"'
            ]);
        }

        return $next($request);
    })
    ->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('admin.index');
        Route::get('/create', [AdminController::class, 'create'])->name('admin.create');
        Route::post('/store', [AdminController::class, 'store'])->name('admin.store');
        Route::delete('/{memory}', [AdminController::class, 'destroy'])->name('admin.destroy');
    });
