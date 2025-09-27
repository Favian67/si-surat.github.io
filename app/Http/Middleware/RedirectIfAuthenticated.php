<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle($request, Closure $next, ...$guards)
    {
        if (Auth::check()) {
            return match (Auth::user()->role) {
                'admin' => redirect()->route('admin.dashboard'),
                'guru_sd' => redirect()->route('guru_sd.dashboard'),
                'guru_smp' => redirect()->route('guru_smp.dashboard'),
                'sekolah_sd' => redirect()->route('sekolah.dashboard'),
                'sekolah_smp' => redirect()->route('sekolah.dashboard'),
                'korwil' => redirect()->route('korwil.dashboard'),
                default => redirect('/login')
            };
        }
        return $next($request);
    }
}
