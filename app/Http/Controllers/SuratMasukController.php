<?php

namespace App\Http\Controllers;

use App\Models\SuratMasuk;
use App\Models\Perihal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SuratMasukController extends Controller
{
    // SuratMasukController.php

    public function index()
    {
        $user = Auth::user();

        // Ambil surat masuk sesuai user login
        $surat = SuratMasuk::where('user_id', $user->id)->latest()->get();

        // Cek role untuk menampilkan view yang sesuai
        if ($user->role == 'guru_sd') {
            return view('guru_sd.surat_masuk.index', compact('surat'));
        } elseif ($user->role == 'guru_smp') {
            return view('guru_smp.surat_masuk.index', compact('surat'));
        } elseif ($user->role == 'sekolah_sd') {
            return view('sekolah.surat_masuk.index', compact('surat'));
        } elseif ($user->role == 'sekolah_smp') {
            return view('sekolah.surat_masuk.index', compact('surat'));
        } elseif ($user->role == 'korwil') {
            return view('korwil.surat_masuk.index', compact('surat'));
        } elseif ($user->role == 'admin') {
            return view('admin.surat_masuk.index', compact('surat'));
        }

        // fallback jika role tidak dikenali
        abort(403, 'Role tidak dikenali');

    }

    public function create()
    {
        $perihals = Perihal::all();
        return view('admin.surat_masuk.create', compact('perihals'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor_surat' => 'required',
            'pengirim' => 'required',
            'tanggal_surat' => 'required|date',
            'perihal_id' => 'required',
            'file' => 'nullable|mimes:pdf,jpg,png|max:2048'
        ]);

        // Simpan file ke storage public/surat_masuk
        $filePath = $request->hasFile('file')
            ? $request->file('file')->store('surat_masuk', 'public')
            : null;

        SuratMasuk::create([
            'nomor_surat' => $request->nomor_surat,
            'pengirim' => $request->pengirim,
            'tanggal_surat' => $request->tanggal_surat,
            'perihal_id' => $request->perihal_id,
            'user_id' => Auth::id(),
            'file' => $filePath
        ]);

        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.surat-masuk.index');
        }
        if (Auth::user()->role === 'guru_smp') {
            return redirect()->route('guru_smp.surat-masuk.index');
        }
        if (Auth::user()->role === 'guru_sd') {
            return redirect()->route('guru_sd.surat-masuk.index');
        }
        if (Auth::user()->role === 'sekolah_sd') {
            return redirect()->route('sekolah.surat-masuk.index');
        }
        if (Auth::user()->role === 'sekolah_sd') {
            return redirect()->route('sekolah.surat-masuk.index');
        }
        if (Auth::user()->role === 'sekolah_smp') {
            return redirect()->route('sekolah.surat-masuk.index');
        }
        if (Auth::user()->role === 'korwil') {
            return redirect()->route('korwil.surat-masuk.index');
        }
    }

    public function edit(SuratMasuk $surat_masuk)
    {
        $perihals = Perihal::all();
        return view('admin.surat_masuk.edit', compact('surat_masuk', 'perihals'));
    }

    public function update(Request $request, SuratMasuk $surat_masuk)
    {
        $request->validate([
            'nomor_surat' => 'required',
            'pengirim' => 'required',
            'tanggal_surat' => 'required|date',
            'perihal_id' => 'required',
            'file' => 'nullable|mimes:pdf,jpg,png|max:2048'
        ]);

        if ($request->hasFile('file')) {
            if ($surat_masuk->file)
                Storage::delete($surat_masuk->file);
            $surat_masuk->file = $request->file('file')->store('surat_masuk');
        }

        $surat_masuk->update($request->only('nomor_surat', 'pengirim', 'tanggal_surat', 'perihal_id', 'file'));

        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.surat-masuk.index');
        }
        if (Auth::user()->role === 'guru_smp') {
            return redirect()->route('guru_smp.surat-masuk.index');
        }
        if (Auth::user()->role === 'guru_sd') {
            return redirect()->route('guru_sd.surat-masuk.index');
        }
        if (Auth::user()->role === 'korwil') {
            return redirect()->route('korwil.surat-masuk.index');
        }
        if (Auth::user()->role === 'sekolah_sd') {
            return redirect()->route('sekolah.surat-masuk.index');
        }
        if (Auth::user()->role === 'sekolah_smp') {
            return redirect()->route('sekolah.surat-masuk.index');
        }
    }

    public function destroy(SuratMasuk $surat_masuk)
    {
        if ($surat_masuk->file)
            Storage::delete($surat_masuk->file);
        $surat_masuk->delete();
        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.surat-masuk.index');
        }
        if (Auth::user()->role === 'guru_smp') {
            return redirect()->route('guru_smp.surat-masuk.index');
        }
        if (Auth::user()->role === 'guru_sd') {
            return redirect()->route('guru_sd.surat-masuk.index');
        }
        if (Auth::user()->role === 'sekolah_sd') {
            return redirect()->route('sekolah.surat-masuk.index');
        }
        if (Auth::user()->role === 'sekolah_smp') {
            return redirect()->route('sekolah.surat-masuk.index');
        }
        if (Auth::user()->role === 'korwil') {
            return redirect()->route('korwil.surat-masuk.index');
        }
    }

    public function approve($id)
    {
        $surat = SuratMasuk::findOrFail($id);

        if (!in_array(Auth::user()->role, ['admin', 'korwil'])) {
            abort(403, 'Hanya admin atau korwil yang dapat menyetujui surat');
        }

        if ($surat->status !== 'pending') {
            return back()->with('info', 'Surat sudah diproses.');
        }

        $surat->update(['status' => 'approved']);

        return redirect()->back()->with('success', 'Surat berhasil di-approve.');
    }


    public function reject($id)
    {
        $surat = SuratMasuk::findOrFail($id);
        $surat->status = 'rejected';
        $surat->save();

        if (!in_array(Auth::user()->role, ['admin', 'korwil'])) {
            abort(403, 'Hanya admin atau korwil yang dapat menolak surat');
        }

        if ($surat->status !== 'pending') {
            return back()->with('info', 'Surat sudah diproses.');
        }

        $surat->update(['status' => 'rejected']);

        return redirect()->back()->with('success', 'Surat berhasil di-reject.');
    }
}