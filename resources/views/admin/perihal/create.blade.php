@extends('layouts.app')
@section('title', 'Tambah Perihal')

@section('content')
<h2 class="text-2xl font-bold mb-4">Tambah Perihal</h2>

<div class="bg-white rounded shadow p-4">
<form method="POST" action="{{ route($rolePrefix.'.perihal.store') }}">
    @csrf
    <label class="block mb-2">Judul</label>
    <input type="text" name="judul" class="w-full border rounded p-2 mb-3" required>

    <label class="block mb-2">Deskripsi</label>
    <textarea name="deskripsi" class="w-full border rounded p-2 mb-3"></textarea>

    <button type="submit" 
            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        Simpan
    </button>
</form>
</div>
@endsection
