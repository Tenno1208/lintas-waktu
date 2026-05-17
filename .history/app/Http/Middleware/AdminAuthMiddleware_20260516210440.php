<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminAuthMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah session login admin aktif
        if (!session()->has('admin_logged_in')) {
            return redirect()->route('login')->with('error', 'Sesi berakhir atau memerlukan akses masuk.');
        }

        return $next($request);
    }
}