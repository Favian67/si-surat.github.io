@extends('layouts.app')
@section('title', 'Tambah Surat Masuk')

@section('content')
<h2 class="text-2xl font-bold mb-4">Tambah Surat Masuk</h2>
<div class="bg-white rounded shadow p-4">
<form method="POST" enctype="multipart/form-data" action="{{ route($rolePrefix.'.surat-masuk.store') }}">
    @csrf
    <label class="block mb-2">Nomor Surat</label>
    <input type="text" name="nomor_surat" class="w-full border rounded p-2 mb-3">

    <label class="block mb-2">Pengirim</label>
    <input type="text" name="pengirim" class="w-full border rounded p-2 mb-3">

    <label class="block mb-2">Tanggal Surat</label>
    <input type="date" name="tanggal_surat" class="w-full border rounded p-2 mb-3">

    <label class="block mb-2">Perihal</label>
    <select name="perihal_id" class="w-full border rounded p-2 mb-3">
        @foreach($perihals as $p)
            <option value="{{ $p->id }}">{{ $p->judul }}</option>
        @endforeach
    </select>

    <label class="block mb-2">File (PDF/JPG/PNG)</label>
    <input type="file" name="file" class="w-full border rounded p-2 mb-3">

    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        Simpan
    </button>
</form>
</div>
@endsection
