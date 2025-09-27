@extends('layouts.app')
@section('title', 'Edit Surat Masuk')

@section('content')
<h2 class="text-2xl font-bold mb-4">Edit Surat Masuk</h2>

<div class="bg-white rounded shadow p-4">
<form method="POST" enctype="multipart/form-data" action="{{ route('surat-masuk.update', $surat_masuk->id) }}">
    @csrf @method('PUT')

    <label class="block mb-2">Nomor Surat</label>
    <input type="text" name="nomor_surat" value="{{ $surat_masuk->nomor_surat }}" 
           class="w-full border rounded p-2 mb-3" required>

    <label class="block mb-2">Pengirim</label>
    <input type="text" name="pengirim" value="{{ $surat_masuk->pengirim }}" 
           class="w-full border rounded p-2 mb-3" required>

    <label class="block mb-2">Tanggal Surat</label>
    <input type="date" name="tanggal_surat" value="{{ $surat_masuk->tanggal_surat }}" 
           class="w-full border rounded p-2 mb-3" required>

    <label class="block mb-2">Perihal</label>
    <select name="perihal_id" class="w-full border rounded p-2 mb-3" required>
        @foreach($perihals as $p)
            <option value="{{ $p->id }}" {{ $surat_masuk->perihal_id == $p->id ? 'selected' : '' }}>
                {{ $p->judul }}
            </option>
        @endforeach
    </select>

    <label class="block mb-2">File (PDF/JPG/PNG)</label>
    @if($surat_masuk->file)
        <p class="mb-2">
            <a href="{{ asset('storage/'.$surat_masuk->file) }}" target="_blank" class="text-blue-600 underline">Lihat File Saat Ini</a>
        </p>
    @endif
    <input type="file" name="file" class="w-full border rounded p-2 mb-3">

    <button type="submit" 
            class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
        Update
    </button>
</form>
</div>
@endsection
