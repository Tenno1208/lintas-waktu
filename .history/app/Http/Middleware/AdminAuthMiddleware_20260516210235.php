<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminAuthMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Ambil data akun dari file .env
        $adminUser = env('ADMIN_USER', 'admin');
        $adminPassword = env('ADMIN_PASSWORD', 'password');

        // Cek autentikasi browser
        if ($request->getUser() != $adminUser || $request->getPassword() != $adminPassword) {
            return response('Akses Ditolak. Memerlukan Autentikasi Lintas Waktu.', 401, [
                'WWW-Authenticate' => 'Basic realm="Admin Lintas Waktu"'
            ]);
        }

        return $next($request);
    }
}