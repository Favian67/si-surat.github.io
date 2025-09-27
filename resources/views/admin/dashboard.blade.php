<!-- resources/views/admin/dashboard.blade.php -->

@extends('layouts.app')
@section('title', 'Dashboard Admin PPTK')

@section('content')
<h2 class="text-2xl font-bold mb-6">Dashboard Admin PPTK</h2>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
    <div class="bg-white p-6 rounded shadow text-center">
        <h3 class="text-gray-500">Surat Masuk</h3>
        <p class="text-3xl font-bold text-blue-600">{{ $totalSuratMasuk }}</p>
    </div>
    <div class="bg-white p-6 rounded shadow text-center">
        <h3 class="text-gray-500">Surat Keluar</h3>
        <p class="text-3xl font-bold text-green-600">{{ $totalSuratKeluar }}</p>
    </div>
    <div class="bg-white p-6 rounded shadow text-center">
        <h3 class="text-gray-500">Total User</h3>
        <p class="text-3xl font-bold text-purple-600">{{ $totalUser }}</p>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div class="bg-white p-4 rounded shadow">
        <h3 class="text-lg font-bold mb-3">Surat Masuk Terbaru</h3>
        <table class="w-full border-collapse border border-gray-300">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border p-2">No</th>
                    <th class="border p-2">Nomor Surat</th>
                    <th class="border p-2">Pengirim</th>
                    <th class="border p-2">Perihal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($suratMasukTerbaru as $i => $sm)
                <tr>
                    <td class="border p-2">{{ $i+1 }}</td>
                    <td class="border p-2">{{ $sm->nomor_surat }}</td>
                    <td class="border p-2">{{ $sm->pengirim }}</td>
                    <td class="border p-2">{{ $sm->perihal->judul }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="bg-white p-4 rounded shadow">
        <h3 class="text-lg font-bold mb-3">Surat Keluar Terbaru</h3>
        <table class="w-full border-collapse border border-gray-300">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border p-2">No</th>
                    <th class="border p-2">Nomor Surat</th>
                    <th class="border p-2">Penerima</th>
                    <th class="border p-2">Perihal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($suratKeluarTerbaru as $i => $sk)
                <tr>
                    <td class="border p-2">{{ $i+1 }}</td>
                    <td class="border p-2">{{ $sk->nomor_surat }}</td>
                    <td class="border p-2">{{ $sk->penerima }}</td>
                    <td class="border p-2">{{ $sk->perihal->judul }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
