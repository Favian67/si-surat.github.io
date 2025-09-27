@extends('layouts.app')
@section('title', 'Surat Masuk - Korwil')

@section('content')
    <div class="max-w-6xl mx-auto bg-white p-6 rounded-2xl shadow-lg">
        <h2 class="text-3xl font-bold mb-6 text-gray-800">Surat Masuk Anda</h2>

        <div class="overflow-x-auto">
            <table class="w-full border border-gray-200 rounded-lg">
                <thead class="bg-gray-50 text-gray-700">
                    <tr>
                        <th class="border-b p-3 text-left">No</th>
                        <th class="border-b p-3 text-left">Nomor Surat</th>
                        <th class="border-b p-3 text-left">Pengirim</th>
                        <th class="border-b p-3 text-left">Perihal</th>
                        <th class="border-b p-3 text-left">Tanggal Surat</th>
                        <th class="border-b p-3 text-left">File</th>
                        <th class="border-b p-3 text-left">Status</th>
                        <th class="border-b p-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($surat as $index => $surat)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="p-3">{{ $index + 1 }}</td>
                            <td class="p-3 font-medium text-gray-800">{{ $surat->nomor_surat }}</td>
                            <td class="p-3">{{ $surat->pengirim }}</td>
                            <td class="p-3">{{ $surat->perihal }}</td>
                            <td class="p-3">{{ \Carbon\Carbon::parse($surat->tanggal_surat)->format('d M Y') }}</td>
                            <td class="p-3">
                                @if($surat->file)
                                    <a href="{{ asset('storage/' . $surat->file) }}" target="_blank"
                                        class="text-blue-600 hover:text-blue-800 underline">
                                        Lihat
                                    </a>
                                @else
                                    <span class="text-gray-400 italic">Tidak ada file</span>
                                @endif
                            </td>
                            <td class="p-3">
                                @if(auth()->user()->role == 'korwil')
    <form action="{{ route('korwil.surat-keluar.approve', $s->id) }}" method="POST" class="inline-block">
        @csrf
        <button type="submit" class="bg-blue-500 text-white px-2 py-1 rounded"
            onclick="return confirm('Setujui surat ini?')">Approve</button>
    </form>
@endif

                                    <form action="{{ route('surat-masuk.reject', $s->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">
                                            Reject
                                        </button>
                                    </form>
                                @else
                                    <span
                                        class="px-2 py-1 rounded text-sm
                                                {{ $s->status === 'approved' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                        {{ ucfirst($s->status) }}
                                    </span>
                                @endif
                            </td>
                            <td class="p-3 text-center">
                                @if(Auth::user()->role == 'korwil')
                                    @if($surat->status == 'pending')
                                        <form method="POST"
                                            action="{{ route(Auth::user()->role . '.surat-keluar.approve', $surat->id) }}">
                                            @csrf
                                            <button class="bg-green-500 text-white px-2 py-1 rounded">Approve</button>
                                        </form>
                                        <form method="POST" action="{{ route(Auth::user()->role . '.surat-keluar.reject', $surat->id) }}">
                                            @csrf
                                            <button class="bg-red-500 text-white px-2 py-1 rounded">Reject</button>
                                        </form>
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center p-6 text-gray-500">Tidak ada surat masuk.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection