<?php

use App\Http\Controllers\AdminController;
use App\Http\Middleware\AdminAuthMiddleware;
use App\Models\Memory;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

// Halaman Depan
Route::get('/', function () {
    $memories = Memory::latest('event_date')->get();
    return view('welcome', compact('memories'));
});

// Proses Auth Custom Admin
Route::get('/admin/login', function () {
    if (session()->has('admin_logged_in')) {
        return redirect()->route('admin.index');
    }
    return view('admin.login');
})->name('login');

Route::post('/admin/login', function (Request $request) {
    if ($request->username === env('ADMIN_USER', 'admin') && $request->password === env('ADMIN_PASSWORD', 'password')) {
        session(['admin_logged_in' => true]);
        return redirect()->route('admin.index');
    }
    return back()->with('error', 'Identitas atau Kunci Sandi Salah!');
});

Route::post('/admin/logout', function () {
    session()->forget('admin_logged_in');
    return redirect('/');
})->name('logout');


// Dashboard Admin (Dilindungi Custom Session Middleware)
Route::prefix('admin')
    ->middleware(AdminAuthMiddleware::class)
    ->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('admin.index');
        Route::get('/create', [AdminController::class, 'create'])->name('admin.create');
        Route::match(['get', 'post'], '/store', function(Request $request) {
    if ($request->isMethod('get')) {
        return redirect()->route('admin.create');
    }
    return app()->make(App\Http\Controllers\AdminController::class)->store($request);
})->name('admin.store');
        Route::delete('/{memory}', [AdminController::class, 'destroy'])->name('admin.destroy');
        Route::get('/{id}/edit', [AdminController::class, 'edit'])->name('admin.edit');
    Route::put('/{id}/update', [AdminController::class, 'update'])->name('admin.update');
    });

Route::get('/timeline', function () {
    $memories = App\Models\Memory::oldest('event_date')->get();
    return view('timeline', compact('memories'));
})->name('timeline');