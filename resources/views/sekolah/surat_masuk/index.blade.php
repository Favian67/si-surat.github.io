@extends('layouts.app')
@section('title', 'Surat Masuk Tenaga Pendidik')

@section('content')
    <h2 class="text-2xl font-bold mb-4">Surat Masuk Anda</h2>
    <div class="bg-white rounded shadow">
        <table class="w-full border-collapse border border-gray-300">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border p-2">No</th>
                    <th class="border p-2">Nomor Surat</th>
                    <th class="border p-2">Pengirim</th>
                    <th class="border p-2">Perihal</th>
                    <th class="border p-2">Tanggal Surat</th>
                    <th class="border p-2">File</th>
                    <th class="border p-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($surat as $i => $s)
                    <tr class="hover:bg-gray-50">
                        <td class="border p-2">{{ $i + 1 }}</td>
                        <td class="border p-2">{{ $s->nomor_surat }}</td>
                        <td class="border p-2">{{ $s->pengirim }}</td>
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
                            <form method="POST" action="{{ route('sekolah.surat-masuk.destroy', $s->id) }}"
                                class="inline-block">
                                @csrf @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded"
                                    onclick="return confirm('Yakin hapus surat ini?')">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-gray-500 p-4">Tidak ada surat masuk</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection