@extends('layouts.app')

@section('content')
    <div class="p-6">
        <div class="bg-white shadow rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-700">Surat Keluar Anda</h2>
                <a href="{{ route('guru_sd.surat-keluar.create') }}"
                    class="inline-flex items-center px-4 py-2 bg-green-600 text-white text-sm font-medium rounded-md shadow hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-400">
                    ➕ Tambah Surat
                </a>
            </div>
            <div class="p-6 overflow-x-auto">
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
                                <td class="px-4 py-2 border">{{ $s->perihal->nama }}</td>
                                <td class="px-4 py-2 border text-center">
                                    <span
                                        class="px-3 py-1 rounded 
                            {{ $s->status === 'approved' ? 'bg-green-100 text-green-700' : ($s->status === 'rejected' ? 'bg-red-100 text-red-700' : 'bg-yellow-100 text-yellow-700') }}">
                                        {{ ucfirst($s->status ?? 'pending') }}
                                    </span>
                                </td>
                                <td class="px-4 py-2 border">
                                    @if($s->file)
                                        <a href="{{ asset('storage/' . $s->file) }}" target="_blank"
                                            class="text-blue-600 hover:underline">📄 Lihat</a>
                                    @else
                                        <span class="text-gray-400">Tidak ada</span>
                                    @endif
                                </td>
                                <td class="px-4 py-2 border text-center">
                                    <!-- Tombol Edit -->
                                    <a href="{{ route('guru_sd.surat-keluar.edit', $s->id) }}"
                                        class="inline-flex items-center px-3 py-1 bg-yellow-500 text-white text-xs font-medium rounded-md shadow hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-300">
                                        ✏️ Edit
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-4 py-4 text-center text-gray-500">
                                    Tidak ada surat keluar
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection