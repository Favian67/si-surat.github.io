@extends('layouts.app')
@section('title', 'Edit Perihal')

@section('content')
<h2 class="text-2xl font-bold mb-4">Edit Perihal</h2>

<div class="bg-white rounded shadow p-4">
<form method="POST" action="{{ route($rolePrefix.'.perihal.update', $perihal->id) }}">
    @csrf @method('PUT')
    <label class="block mb-2">Judul</label>
    <input type="text" name="judul" value="{{ $perihal->judul }}" 
           class="w-full border rounded p-2 mb-3" required>

    <label class="block mb-2">Deskripsi</label>
    <textarea name="deskripsi" class="w-full border rounded p-2 mb-3">{{ $perihal->deskripsi }}</textarea>

    <button type="submit" 
            class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
        Update
    </button>
</form>
</div>
@endsection
