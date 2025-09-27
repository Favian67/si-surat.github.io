<?php

namespace App\Http\Controllers;

use App\Models\SuratMasuk;
use App\Models\SuratKeluar;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        $suratMasuk = SuratMasuk::with('perihal')->get();
        $suratKeluar = SuratKeluar::with('perihal')->get();
        return view('admin.laporan.index', compact('suratMasuk', 'suratKeluar'));
    }

    public function exportMasuk()
    {
        $suratMasuk = SuratMasuk::with('perihal')->get();
        $pdf = Pdf::loadView('admin.laporan.pdf_masuk', compact('suratMasuk'));
        return $pdf->download('laporan_surat_masuk.pdf');

        $suratMasuk = SuratMasuk::with('perihal')->get();
        $pdf = Pdf::loadView('guru.laporan.pdf_masuk', compact('suratMasuk'));
        return $pdf->download('laporan_surat_masuk.pdf');

        $suratMasuk = SuratMasuk::with('perihal')->get();
        $pdf = Pdf::loadView('korwil.laporan.pdf_masuk', compact('suratMasuk'));
        return $pdf->download('laporan_surat_masuk.pdf');
        
    }

    public function exportKeluar()
    {
        $suratKeluar = SuratKeluar::with('perihal')->get();
        $pdf = Pdf::loadView('admin.laporan.pdf_keluar', compact('suratKeluar'));
        return $pdf->download('laporan_surat_keluar.pdf');

        $suratKeluar = SuratKeluar::with('perihal')->get();
        $pdf = Pdf::loadView('guru.laporan.pdf_keluar', compact('suratKeluar'));
        return $pdf->download('laporan_surat_keluar.pdf');

        $suratKeluar = SuratKeluar::with('perihal')->get();
        $pdf = Pdf::loadView('korwil.laporan.pdf_keluar', compact('suratKeluar'));
        return $pdf->download('laporan_surat_keluar.pdf');
    }

    public function guruIndex()
    {
        $user = Auth::user();
        $suratMasuk = SuratMasuk::where('user_id', $user->id)->get();
        $suratKeluar = SuratKeluar::where('user_id', $user->id)->get();

        return view('guru.laporan.index', compact('suratMasuk', 'suratKeluar'));
    }

    public function guruCetak()
    {
        $user = Auth::user();
        $suratMasuk = SuratMasuk::where('user_id', $user->id)->get();
        $suratKeluar = SuratKeluar::where('user_id', $user->id)->get();

        $pdf = Pdf::loadView('guru.laporan.cetak', compact('suratMasuk', 'suratKeluar', 'user'));
        return $pdf->download('Laporan_'.$user->name.'.pdf');
    }

}
