<?php

namespace App\Http\Controllers;

use App\Models\SuratKeluar;
use App\Models\Perihal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\SuratMasuk;
use App\Models\User;

class SuratKeluarController extends Controller
{
    public function index()
    {
        $role = Auth::user()->role;
        $userId = Auth::id();

        // default
        $surat = collect();
        $view = null;

        switch ($role) {
            case 'admin':
                $surat = SuratKeluar::where('user_id', $userId)
                    ->with('perihal')
                    ->orderBy('created_at', 'desc')
                    ->get();
                $view = 'admin.surat_keluar.index';
                break;

            case 'korwil':
                $surat = SuratKeluar::where('user_id', $userId)->with('perihal')->orderBy('created_at', 'desc')->get();
                $view = 'korwil.surat_keluar.index';
                break;

            case 'guru_sd':
                $surat = SuratKeluar::where('user_id', $userId)->with('perihal')->orderBy('created_at', 'desc')->get();
                $view = 'guru_sd.surat_keluar.index';
                break;

            case 'guru_smp':
                $surat = SuratKeluar::where('user_id', $userId)->with('perihal')->orderBy('created_at', 'desc')->get();
                $view = 'guru_smp.surat_keluar.index';
                break;

            case 'sekolah_sd':
            case 'sekolah_smp':
                $surat = SuratKeluar::where('user_id', $userId)->with('perihal')->orderBy('created_at', 'desc')->get();
                $view = 'sekolah.surat_keluar.index';
                break;

            default:
                abort(403, 'Akses ditolak');
        }

        // Pastikan view terdefinisi (aman)
        if (!$view)
            abort(500, 'View untuk role belum diset.');

        return view($view, compact('surat'));
    }

    public function create()
    {
        $perihals = Perihal::all();

        if (Auth::user()->role === 'guru_sd') {
            $users = User::whereIn('role', ['korwil', 'admin'])->get();
            return view('guru_sd.surat_keluar.create', compact('users', 'perihals'));
        }

        if (Auth::user()->role === 'guru_smp') {
            $users = User::where('role', 'admin')->get();
            return view('guru_smp.surat_keluar.create', compact('users', 'perihals'));
        }

        if (in_array(Auth::user()->role, ['sekolah_sd', 'sekolah_smp'])) {
            $users = User::where('role', 'admin')->get();
            return view('sekolah.surat_keluar.create', compact('users', 'perihals'));
        }

        if (Auth::user()->role === 'admin') {
            $users = User::where('id', '!=', Auth::id())->get();
            return view('admin.surat_keluar.create', compact('users', 'perihals'));
        }

        if (Auth::user()->role === 'korwil') {
            $users = User::whereIn('role', ['sekolah_sd', 'guru_sd'])->get();
            return view('korwil.surat_keluar.create', compact('users', 'perihals'));
        }

        abort(403, 'Akses ditolak');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor_surat' => 'required',
            'penerima' => 'required',
            'tanggal_surat' => 'required|date',
            'perihal_id' => 'required',
            'file' => 'nullable|mimes:pdf,jpg,png|max:2048',
            'tujuan_id' => 'required'
        ]);

        $filePath = $request->hasFile('file')
            ? $request->file('file')->store('surat_keluar', 'public')
            : null;

        $suratKeluar = SuratKeluar::create([
            'nomor_surat' => $request->nomor_surat,
            'penerima' => $request->penerima,
            'tanggal_surat' => $request->tanggal_surat,
            'perihal_id' => $request->perihal_id,
            'user_id' => Auth::id(),
            'tujuan_id' => $request->tujuan_id,
            'file' => $filePath,
            'status' => 'pending'
        ]);


        // === Logika distribusi surat ===
        switch (Auth::user()->role) {
            case 'admin':
                if ($request->tujuan_id === 'semua') {
                    $tujuanList = User::whereIn('role', ['sekolah_sd', 'sekolah_smp', 'guru_sd', 'guru_smp', 'korwil'])->get();
                    foreach ($tujuanList as $tujuan) {
                        SuratMasuk::create([
                            'nomor_surat' => $suratKeluar->nomor_surat,
                            'pengirim' => Auth::user()->name,
                            'tanggal_surat' => $suratKeluar->tanggal_surat,
                            'perihal_id' => $suratKeluar->perihal_id,
                            'user_id' => $tujuan->id,
                            'file' => $filePath
                        ]);
                    }
                } else {
                    SuratMasuk::create([
                        'nomor_surat' => $suratKeluar->nomor_surat,
                        'pengirim' => Auth::user()->name,
                        'tanggal_surat' => $suratKeluar->tanggal_surat,
                        'perihal_id' => $suratKeluar->perihal_id,
                        'user_id' => $request->tujuan_id,
                        'file' => $filePath
                    ]);
                }
                break;

            case 'guru_sd':
                // Guru SD bisa kirim ke admin atau korwil
                SuratMasuk::create([
                    'nomor_surat' => $suratKeluar->nomor_surat,
                    'pengirim' => Auth::user()->name,
                    'tanggal_surat' => $suratKeluar->tanggal_surat,
                    'perihal_id' => $suratKeluar->perihal_id,
                    'user_id' => $request->tujuan_id, // langsung ke tujuan (admin / korwil)
                    'file' => $filePath,
                    'status' => 'pending'
                ]);
                break;

            case 'guru_smp':
                // Guru SMP hanya ke admin
                $admin = User::where('role', 'admin')->first();
                SuratMasuk::create([
                    'nomor_surat' => $suratKeluar->nomor_surat,
                    'pengirim' => Auth::user()->name,
                    'tanggal_surat' => $suratKeluar->tanggal_surat,
                    'perihal_id' => $suratKeluar->perihal_id,
                    'user_id' => $admin->id,
                    'file' => $filePath,
                    'status' => 'pending'
                ]);
                break;


            case 'sekolah_sd':
            case 'sekolah_smp':
                $admin = User::where('role', 'admin')->first();
                $suratKeluar->update(['status' => 'pending']); // pending sampai korwil approve
                SuratMasuk::create([
                    'nomor_surat' => $suratKeluar->nomor_surat,
                    'pengirim' => Auth::user()->name,
                    'tanggal_surat' => $suratKeluar->tanggal_surat,
                    'perihal_id' => $suratKeluar->perihal_id,
                    'user_id' => $admin->id,
                    'file' => $filePath
                ]);
                break;

            case 'korwil':
                $sekolah = User::whereIn('role', ['sekolah_sd', 'sekolah_smp'])->first();
                SuratMasuk::create([
                    'nomor_surat' => $suratKeluar->nomor_surat,
                    'pengirim' => Auth::user()->name,
                    'tanggal_surat' => $suratKeluar->tanggal_surat,
                    'perihal_id' => $suratKeluar->perihal_id,
                    'user_id' => $sekolah->id,
                    'file' => $filePath
                ]);
                break;
        }

        return back()->with('success', 'Surat keluar berhasil diproses.');
    }

    public function edit(SuratKeluar $surat_keluar)
    {
        $users = User::where('id', '!=', Auth::id())->get();
        $perihals = Perihal::all();
        // kalau role nya guru_smp
        if (Auth::user()->role === 'guru_smp') {
            return view('guru_smp.surat_keluar.edit', compact('surat_keluar', 'perihals', 'users'));
        }

        // kalau role nya guru_sd
        if (Auth::user()->role === 'guru_sd') {
            return view('guru_sd.surat_keluar.edit', compact('surat_keluar', 'perihals', 'users'));
        }

        // kalau role nya sekolah
        if (in_array(Auth::user()->role, ['sekolah_sd', 'sekolah_smp'])) {
            return view('sekolah.surat_keluar.edit', compact('surat_keluar', 'perihals', 'users'));
        }

        // kalau role nya korwil 
        if (Auth::user()->role === 'korwil') {
            return view('korwil.surat_keluar.edit', compact('surat_keluar', 'perihals', 'users'));
        }

        return view('admin.surat_keluar.edit', compact('surat_keluar', 'perihals', 'users'));
    }


    public function update(Request $request, SuratKeluar $surat_keluar)
    {
        $request->validate([
            'nomor_surat' => 'required',
            'penerima' => 'required',
            'tanggal_surat' => 'required|date',
            'perihal_id' => 'required',
            'file' => 'nullable|mimes:pdf,jpg,png|max:2048'
        ]);

        if ($request->hasFile('file')) {
            if ($surat_keluar->file)
                Storage::delete($surat_keluar->file);
            $surat_keluar->file = $request->file('file')->store('surat_keluar');
        }

        $surat_keluar->update($request->only('nomor_surat', 'penerima', 'tanggal_surat', 'perihal_id', 'file'));

        return redirect()->route(Auth::user()->role . '.surat-keluar.index')->with('success', 'Surat keluar berhasil diperbarui');
    }

    public function approve($id)
    {
        $surat = SuratKeluar::with('user')->findOrFail($id);

        // hanya admin & korwil yg bisa approve
        if (!in_array(Auth::user()->role, ['admin', 'korwil'])) {
            abort(403, 'Hanya admin atau korwil yang dapat menyetujui surat');
        }

        if ($surat->status !== 'pending') {
            return back()->with('info', 'Surat sudah diproses.');
        }

        // update status surat keluar guru
        $surat->update(['status' => 'approved']);

        // teruskan ke admin (jika yang approve korwil)
        if (Auth::user()->role === 'korwil') {
            $admin = User::where('role', 'admin')->first();

            SuratMasuk::create([
                'nomor_surat' => $surat->nomor_surat,
                'pengirim' => $surat->user?->name ?? 'Tidak Diketahui',
                'tanggal_surat' => $surat->tanggal_surat,
                'perihal_id' => $surat->perihal_id,
                'user_id' => $admin->id,
                'file' => $surat->file
            ]);
        }

        return back()->with('success', 'Surat telah disetujui.');
    }


    public function reject($id)
    {
        $surat = SuratKeluar::with('user')->findOrFail($id);

        if ($surat->user->role === 'guru_sd') {
            if (!in_array(Auth::user()->role, ['korwil', 'admin'])) {
                abort(403, 'Hanya korwil atau admin yang dapat menolak surat dari guru SD');
            }
        }

        if ($surat->user->role === 'guru_smp') {
            if (Auth::user()->role !== 'admin') {
                abort(403, 'Hanya admin yang dapat menolak surat dari guru SMP');
            }
        }

        if ($surat->status !== 'pending') {
            return back()->with('info', 'Surat sudah diproses.');
        }

        $surat->update(['status' => 'rejected']);

        return back()->with('success', 'Surat telah ditolak.');
    }

    public function destroy($id)
    {
        $surat = SuratKeluar::findOrFail($id);
        $surat->delete();

        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.surat-keluar.index')->with('success', 'Surat keluar berhasil dihapus');
        }

        if (Auth::user()->role === 'guru_smp') {
            return redirect()->route('guru_smp.surat-keluar.index')->with('success', 'Surat keluar berhasil dihapus');
        }

        if (Auth::user()->role === 'guru_sd') {
            return redirect()->route('guru_sd.surat-keluar.index')->with('success', 'Surat keluar berhasil dihapus');
        }

        if (Auth::user()->role === 'korwil') {
            return redirect()->route('korwil.surat-keluar.index')->with('success', 'Surat keluar berhasil dihapus');
        }
    }

}
