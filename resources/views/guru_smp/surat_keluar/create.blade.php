
@extends('layouts.app')
@section('title', 'Tambah Surat Keluar')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4">Tambah Surat Keluar</h2>

    <form action="{{ route(Auth::user()->role .'.surat-keluar.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
        <label class="block mb-2">Nomor Surat</label>
        <input type="text" name="nomor_surat" class="w-full border rounded p-2 mb-3" required>

        <label class="block mb-2">Penerima</label>
        <input type="text" name="penerima" class="w-full border rounded p-2 mb-3" required>

        <label class="block mb-2">Tanggal Surat</label>
        <input type="date" name="tanggal_surat" class="w-full border rounded p-2 mb-3" required>

        <label class="block mb-2">Perihal</label>
        <select name="perihal_id" class="w-full border rounded p-2 mb-3">
            @foreach($perihals as $p)
                <option value="{{ $p->id }}">{{ $p->judul }}</option>
            @endforeach
        </select>

        <label class="block mb-2">Tujuan</label>
        <select name="tujuan_id" class="w-full border rounded p-2 mb-3">
            @foreach($users as $u)
                <option value="{{ $u->id }}">{{ $u->name }} ({{ ucfirst($u->role) }})</option>
            @endforeach
        </select>

        <label class="block mb-2">File</label>
        <input type="file" name="file" class="w-full border rounded p-2 mb-3">

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Kirim</button>
</form>
</div>
@endsection
