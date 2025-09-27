@extends('layouts.app')
@section('title', 'Tambah User')

@section('content')
<h2 class="text-2xl font-bold mb-4">Tambah User</h2>

<div class="bg-white rounded shadow p-4">
<form method="POST" action="{{ route($rolePrefix.'.users.store') }}">
    @csrf
    <label class="block mb-2">Nama</label>
    <input type="text" name="name" class="w-full border rounded p-2 mb-3" required>

    <label class="block mb-2">Email</label>
    <input type="email" name="email" class="w-full border rounded p-2 mb-3" required>

    <label class="block mb-2">Password</label>
    <input type="password" name="password" class="w-full border rounded p-2 mb-3" required>

    <label class="block mb-2">Role</label>
    <select name="role" class="w-full border rounded p-2 mb-3" required>
        <option value="admin">Admin</option>
        <option value="tenaga_pendidik">Tenaga Pendidik</option>
        <option value="tenaga_pendidiksd">Tenaga Pendidik SD</option>
        <option value="korwil">Korwil</option>
    </select>
    <button type="submit" 
            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        Simpan
    </button>
</form>
</div>
@endsection
