@extends('layouts.app')
@section('title', 'Dashboard Tenaga Pendidik')

@section('content')
<h2 class="text-2xl font-bold mb-4">Dashboard Tenaga Pendidik</h2>

<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
    <div class="bg-white p-6 rounded shadow text-center">
        <h3 class="text-gray-500 mb-2">Surat Masuk Anda</h3>
        <p class="text-4xl font-bold text-blue-600">{{ $masuk }}</p>
    </div>
    <div class="bg-white p-6 rounded shadow text-center">
        <h3 class="text-gray-500 mb-2">Surat Keluar Anda</h3>
        <p class="text-4xl font-bold text-green-600">{{ $keluar }}</p>
    </div>
</div>

<div class="bg-white p-6 rounded shadow">
    <h3 class="text-lg font-bold mb-3">Aktivitas Terbaru</h3>
    <ul class="list-disc pl-5 text-gray-700">
        <li>Cek surat masuk terbaru di menu Surat Masuk</li>
        <li>Kirim surat keluar di menu Surat Keluar</li>
    </ul>
</div>
@endsection
