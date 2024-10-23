<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class EnsureUserIsAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Periksa jika user tidak terautentikasi
        if (!Auth::check()) {
            // Jika tidak, redirect ke halaman login
            return redirect()->route('login');
        }

        // Jika terautentikasi, lanjutkan request ke next middleware
        return $next($request);
    }
}
