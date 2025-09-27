<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $remember = $request->filled('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            // 🔥 Redirect sesuai role
            return match (Auth::user()->role) {
                'admin' => redirect()->route('admin.dashboard'),
                'guru_sd' => redirect()->route('guru_sd.dashboard'),
                'guru_smp' => redirect()->route('guru_smp.dashboard'),
                'sekolah_sd' => redirect()->route('sekolah.dashboard'),
                'sekolah_smp' => redirect()->route('sekolah.dashboard'),
                'korwil' => redirect()->route('korwil.dashboard'),
                default => redirect('/login')->withErrors(['email' => 'Role tidak dikenali'])
            };
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
