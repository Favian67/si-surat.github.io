@extends('layouts.app')

@section('content')
    <h2 class="text-2xl font-bold mb-4">Laporan Surat</h2>

    <a href="{{ route('tenaga.laporan.cetak') }}"
        class="bg-green-500 text-white px-4 py-2 rounded mb-4 inline-block hover:bg-green-600">
        Cetak Laporan
    </a>

    <div class="bg-white p-4 rounded shadow">
        <h3 class="text-lg font-bold mb-2">Surat Masuk</h3>
        <div class="bg-white rounded shadow p-4">
            <a href="{{ route($rolePrefix . '.laporan.masuk') }}"
                class="bg-blue-600 text-white px-4 py-2 rounded inline-block hover:bg-blue-700 mb-2">
                Export Surat Masuk (PDF)
            </a>
        </div>
        <table class="w-full border-collapse border border-gray-300 mb-6">
            <thead>
                <tr>
                    <th class="border p-2">No</th>
                    <th class="border p-2">Nomor Surat</th>
                    <th class="border p-2">Pengirim</th>
                    <th class="border p-2">Perihal</th>
                    <th class="border p-2">Tanggal</th>
                    <th class="border p-2">File</th>
                </tr>
            </thead>
            <tbody>
                @if($suratMasuk->isEmpty())
                    <tr><td colspan="6" class="border p-2 text-center">Tidak ada data surat masuk.</td></tr>
                @else
                    @foreach($suratMasuk as $i => $sm)
                        <tr>
                            <td class="border p-2">{{ $i + 1 }}</td>
                            <td class="border p-2">{{ $sm->nomor_surat }}</td>
                            <td class="border p-2">{{ $sm->pengirim }}</td>
                            <td class="border p-2">{{ $sm->perihal->judul ?? '-' }}</td>
                            <td class="border p-2">{{ $sm->tanggal_surat }}</td>
                            <td class="border p-2">
                                @if($sm->file)
                                    <a href="{{ asset('storage/' . $sm->file) }}" target="_blank"
                                        class="bg-green-500 text-white px-2 py-1 rounded">Lihat File</a>
                                @else
                                    <span class="text-gray-500">Tidak ada file</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>

        <h3 class="text-lg font-bold mb-2">Surat Keluar</h3>
        <div class="bg-white rounded shadow p-4">
            <a href="{{ route($rolePrefix . '.laporan.keluar') }}"
                class="bg-green-600 text-white px-4 py-2 rounded inline-block hover:bg-green-700">
                Export Surat Keluar (PDF)
            </a>
        </div>
        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr>
                    <th class="border p-2">No</th>
                    <th class="border p-2">Nomor Surat</th>
                    <th class="border p-2">Penerima</th>
                    <th class="border p-2">Perihal</th>
                    <th class="border p-2">Tanggal</th>
                    <th class="border p-2">File</th>
                </tr>
            </thead>
            <tbody>
                @if($suratMasuk->isEmpty())
                    <tr><td colspan="6" class="border p-2 text-center">Tidak ada data surat masuk.</td></tr>
                @else
                @foreach($suratKeluar as $i => $sk)
                    <tr>
                        <td class="border p-2">{{ $i + 1 }}</td>
                        <td class="border p-2">{{ $sk->nomor_surat }}</td>
                        <td class="border p-2">{{ $sk->penerima }}</td>
                        <td class="border p-2">{{ $sk->perihal->judul ?? '-' }}</td>
                        <td class="border p-2">{{ $sk->tanggal_surat }}</td>
                        <td class="border p-2">
                            @if($sk->file)
                                <a href="{{ asset('storage/' . $sk->file) }}" target="_blank"
                                    class="bg-green-500 text-white px-2 py-1 rounded">Lihat File</a>
                            @else
                                <span class="text-gray-500">Tidak ada file</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
@endsection