<?php

namespace App\Http\Controllers;

use App\Models\SuratMasuk;
use App\Models\SuratKeluar;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function admin()
    {
        $adminId = Auth::id();

        $totalSuratMasuk = SuratMasuk::where('user_id', $adminId)->count();
        $totalSuratKeluar = SuratKeluar::where('user_id', $adminId)->count();
        $totalUser = User::count();

        $suratMasukTerbaru = SuratMasuk::where('user_id', $adminId)
            ->with('perihal')
            ->latest()
            ->take(5)
            ->get();

        $suratKeluarTerbaru = SuratKeluar::where('user_id', $adminId)
            ->with('perihal')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalSuratMasuk',
            'totalSuratKeluar',
            'totalUser',
            'suratMasukTerbaru',
            'suratKeluarTerbaru'
        ));
    }


    public function guruSD()
    {
        $user = Auth::user();
        $masuk = SuratMasuk::where('user_id', $user->id)->count();
        $keluar = SuratKeluar::where('user_id', $user->id)->count();

        return view('guru_sd.dashboard', compact('masuk', 'keluar'));
    }

    public function guruSMP()
    {
        $user = Auth::user();
        $masuk = SuratMasuk::where('user_id', $user->id)->count();
        $keluar = SuratKeluar::where('user_id', $user->id)->count();

        return view('guru_smp.dashboard', compact('masuk', 'keluar'));
    }


    public function sekolah()
    {
        $user = Auth::user();
        $masuk = SuratMasuk::where('user_id', $user->id)->count();
        $keluar = SuratKeluar::where('user_id', $user->id)->count();

        return view('sekolah.dashboard', compact('masuk', 'keluar'));
    }

    public function korwil()
    {
        $user = Auth::user();
        $masuk = SuratMasuk::where('user_id', $user->id)->count();
        $keluar = SuratKeluar::where('user_id', $user->id)->count();

        return view('korwil.dashboard', compact('masuk', 'keluar'));
    }
}
