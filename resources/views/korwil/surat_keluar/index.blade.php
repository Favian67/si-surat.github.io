@extends('layouts.app')
@section('title', 'Surat Keluar')

@section('content')
    <h2 class="text-2xl font-bold mb-4">Surat Keluar Anda</h2>
    <a href="{{ route(Auth::user()->role .  '.surat-keluar.create') }}"
        class="bg-blue-600 text-white px-4 py-2 rounded mb-4 inline-block hover:bg-blue-700">
        + Tambah Surat Keluar
    </a>

    <div class="bg-white rounded shadow">
        <table class="w-full border-collapse border border-gray-300">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border p-2">No</th>
                    <th class="border p-2">Nomor Surat</th>
                    <th class="border p-2">Penerima</th>
                    <th class="border p-2">Perihal</th>
                    <th class="border p-2">Tanggal Dikirim</th>
                    <th class="border p-2">File</th>
                    <th class="border p-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($surat as $i => $s)
                    <tr class="hover:bg-gray-50">
                        <td class="border p-2">{{ $i + 1 }}</td>
                        <td class="border p-2">{{ $s->nomor_surat }}</td>
                        <td class="border p-2">{{ $s->penerima }}</td>
                        <td class="border p-2">{{ $s->perihal->judul }}</td>
                        <td class="border p-2">{{ \Carbon\Carbon::parse($s->tanggal_surat)->format('d M Y H:i') }}</td>
                        <td class="border p-2">
                            @if($s->file)
                                <a href="{{ asset('storage/' . $s->file) }}" target="_blank"
                                    class="bg-green-500 text-white px-2 py-1 rounded">Lihat File</a>
                            @else
                                <span class="text-gray-500">Tidak ada file</span>
                            @endif
                        </td>
                        <td class="border p-2">
                            <a href="{{ route(Auth::user()->role .  '.surat-keluar.edit', $s->id) }}"
                                class="bg-yellow-500 text-white px-2 py-1 rounded">Edit</a>
                            <form method="POST" action="{{ route(Auth::user()->role .  '.surat-keluar.destroy', $s->id) }}"
                                class="inline-block">
                                @csrf @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded"
                                    onclick="return confirm('Yakin hapus?')">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-gray-500 p-4">Tidak ada surat keluar</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection