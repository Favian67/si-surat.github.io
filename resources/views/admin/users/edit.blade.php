@extends('layouts.app')
@section('title', 'Edit User')

@section('content')
<h2 class="text-2xl font-bold mb-4">Edit User</h2>

<div class="bg-white rounded shadow p-4">
<form method="POST" action="{{ route($rolePrefix.'.users.update', $user->id) }}">
    @csrf @method('PUT')
    <label class="block mb-2">Nama</label>
    <input type="text" name="name" value="{{ $user->name }}" 
           class="w-full border rounded p-2 mb-3" required>

    <label class="block mb-2">Email</label>
    <input type="email" name="email" value="{{ $user->email }}" 
           class="w-full border rounded p-2 mb-3" required>

    <label class="block mb-2">Password (kosongkan jika tidak diubah)</label>
    <input type="password" name="password" class="w-full border rounded p-2 mb-3">

    <label class="block mb-2">Role</label>
    <select name="role" class="w-full border rounded p-2 mb-3" required>
        <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
        <option value="tenaga_pendidik" {{ $user->role == 'tenaga_pendidik' ? 'selected' : '' }}>Tenaga Pendidik</option>
        <option value="tenaga_pendidiksd" {{ $user->role == 'tenaga_pendidiksd' ? 'selected' : '' }}>Tenaga Pendidik SD</option>
        <option value="korwil" {{ $user->role == 'korwil' ? 'selected' : '' }}>Korwil</option>
    </select>

    <button type="submit" 
            class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
        Update
    </button>
</form>
</div>
@endsection
