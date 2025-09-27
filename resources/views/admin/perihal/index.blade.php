@extends('layouts.app')
@section('title', 'Perihal')

@section('content')
<h2 class="text-2xl font-bold mb-4">Perihal Surat</h2>
<a href="{{ route($rolePrefix.'.perihal.create') }}" 
   class="bg-blue-600 text-white px-4 py-2 rounded mb-4 inline-block hover:bg-blue-700">
   + Tambah Perihal
</a>

<div class="bg-white rounded shadow">
    <table class="w-full border-collapse border border-gray-300">
        <thead class="bg-gray-100">
            <tr>
                <th class="border p-2">No</th>
                <th class="border p-2">Judul</th>
                <th class="border p-2">Deskripsi</th>
                <th class="border p-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($perihals as $i => $p)
            <tr class="hover:bg-gray-50">
                <td class="border p-2">{{ $i+1 }}</td>
                <td class="border p-2">{{ $p->judul }}</td>
                <td class="border p-2">{{ $p->deskripsi }}</td>
                <td class="border p-2">
                    <a href="{{ route($rolePrefix.'.perihal.edit', $p->id) }}" 
                       class="bg-yellow-500 text-white px-2 py-1 rounded">Edit</a>
                    <form method="POST" action="{{ route($rolePrefix.'.perihal.destroy', $p->id) }}" 
                          class="inline-block">
                        @csrf @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded"
                                onclick="return confirm('Hapus perihal ini?')">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
