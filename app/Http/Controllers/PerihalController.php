<?php

namespace App\Http\Controllers;

use App\Models\Perihal;
use Illuminate\Http\Request;

class PerihalController extends Controller
{
    public function index()
    {
        $perihals = Perihal::latest()->get();
        return view('admin.perihal.index', compact('perihals'));
    }

    public function create()
    {
        return view('admin.perihal.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string'
        ]);

        Perihal::create($request->all());

        return redirect()->route('perihal.index')->with('success', 'Perihal berhasil ditambahkan');
    }

    public function edit(Perihal $perihal)
    {
        return view('admin.perihal.edit', compact('perihal'));
    }

    public function update(Request $request, Perihal $perihal)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string'
        ]);

        $perihal->update($request->all());

        return redirect()->route('perihal.index')->with('success', 'Perihal berhasil diperbarui');
    }

    public function destroy(Perihal $perihal)
    {
        $perihal->delete();
        return redirect()->route('perihal.index')->with('success', 'Perihal berhasil dihapus');
    }
}
