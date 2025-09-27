@extends('layouts.app')
@section('title', 'Akun User')

@section('content')
<h2 class="text-2xl font-bold mb-4">Akun User</h2>

<a href="{{ route($rolePrefix.'.users.create') }}" 
   class="bg-blue-600 text-white px-4 py-2 rounded mb-4 inline-block hover:bg-blue-700">
   + Tambah User
</a>

<div class="bg-white rounded shadow overflow-hidden">
    <table class="w-full border-collapse border border-gray-300">
        <thead class="bg-gray-100">
            <tr>
                <th class="border p-2">No</th>
                <th class="border p-2">Nama</th>
                <th class="border p-2">Email</th>
                <th class="border p-2">Role</th>
                <th class="border p-2 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $i => $u)
            <tr class="hover:bg-gray-50">
                <td class="border p-2">{{ $i+1 }}</td>
                <td class="border p-2">{{ $u->name }}</td>
                <td class="border p-2">{{ $u->email }}</td>
                <td class="border p-2">{{ ucfirst($u->role) }}</td>
                <td class="border p-2 text-center">
                    <a href="{{ route($rolePrefix.'.users.edit', $u->id) }}" 
                       class="bg-yellow-500 text-white px-2 py-1 rounded hover:bg-yellow-600">Edit</a>
                    <form method="POST" action="{{ route($rolePrefix.'.users.destroy', $u->id) }}" 
                          class="inline-block">
                        @csrf @method('DELETE')
                        <button type="submit" 
                                class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600"
                                onclick="return confirm('Hapus user ini?')">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="border p-4 text-center text-gray-500">Belum ada user</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
