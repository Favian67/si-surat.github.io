@extends('layouts.app')
@section('title', 'Surat Masuk')

@section('content')
    <h2 class="text-2xl font-bold mb-4">Surat Masuk</h2>
    <div class="bg-white rounded shadow">
        <table class="w-full border-collapse border border-gray-300">
            <table class="min-w-full border border-gray-200 rounded-lg overflow-hidden shadow-sm">
                <thead class="bg-gray-100 text-gray-700 text-sm">
                    <tr>
                        <th class="px-4 py-2 border">No</th>
                        <th class="px-4 py-2 border">Nomor Surat</th>
                        <th class="px-4 py-2 border">Penerima</th>
                        <th class="px-4 py-2 border">Tanggal</th>
                        <th class="px-4 py-2 border">Perihal</th>
                        <th class="px-4 py-2 border">Status</th>
                        <th class="px-4 py-2 border">File</th>
                        <th class="px-4 py-2 border">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-sm text-gray-600">
                    @forelse ($surat as $index => $s)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 border text-center">{{ $index + 1 }}</td>
                            <td class="px-4 py-2 border">{{ $s->nomor_surat }}</td>
                            <td class="px-4 py-2 border">{{ $s->penerima }}</td>
                            <td class="px-4 py-2 border">{{ $s->tanggal_surat }}</td>
                            <td class="px-4 py-2 border">{{ $s->perihal->nama ?? '-' }}</td>
                            <td class="flex gap-2">
                                @if($s->status == 'pending')
                                    {{-- Approve --}}
                                    <form action="{{ route('admin.surat-masuk.approve', $s->id) }}" method="POST">
    @csrf
    @method('PATCH')
    <button type="submit" class="bg-green-600 text-white px-2 py-1 rounded">Approve</button>
</form>
<form action="{{ route('admin.surat-masuk.reject', $s->id) }}" method="POST">
    @csrf
    @method('PATCH')
    <button type="submit" class="bg-red-600 text-white px-2 py-1 rounded">Reject</button>
</form>

                                @else
                                    <span class="text-gray-500">Sudah {{ ucfirst($s->status) }}</span>
                                @endif
                            </td>
                            <td class="px-4 py-2 border">
                                @if($s->file)
                                    <a href="{{ asset('storage/' . $s->file) }}" target="_blank"
                                        class="text-blue-600 hover:underline">📄
                                        Lihat</a>
                                @else
                                    <span class="text-gray-400">Tidak ada</span>
                                @endif
                            </td>
                            <td class="px-4 py-2 border text-center">
                                <a href="{{ route('guru_sd.surat-keluar.edit', $s->id) }}"
                                    class="inline-flex items-center px-3 py-1 bg-yellow-500 text-white text-xs font-medium rounded-md shadow hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-300">
                                    ✏️ Edit
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-4 py-4 text-center text-gray-500">
                                Tidak ada surat masuk
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
    </div>
@endsection