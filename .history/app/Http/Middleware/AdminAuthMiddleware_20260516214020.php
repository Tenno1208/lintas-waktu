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
            // Jika user mencoba menembus lewat POST/Store tanpa login, langsung tendang ke login page
            if ($request->isMethod('post')) {
                return redirect()->route('login')->with('error', 'Sesi Anda telah berakhir. Silakan masuk kembali.');
            }
            
            return redirect()->route('login')->with('error', 'Sesi berakhir atau memerlukan akses masuk.');
        }

        return $next($request);
    }
}