@php
    use Illuminate\Support\Str;
    $role = Auth::check() ? Auth::user()->role : null;
@endphp

<head>
    <title>SI Surat - @yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 text-gray-800 flex">

    {{-- Sidebar --}}
    <aside class="w-64 bg-blue-700 text-white min-h-screen">
        <div class="p-4 text-center border-b border-blue-500">
            <img src="{{ asset('images/logo_pwr.png') }}" alt="Logo Purworejo" class="mx-auto w-14 h-16 mb-2">
            <h1 class="text-2xl font-bold">SI Surat</h1>
        </div>
        <nav class="mt-4 space-y-2">
            @if(Auth::check())
                @if($role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 hover:bg-blue-600">Dashboard</a>
                    <a href="{{ route('admin.surat-masuk.index') }}" class="block px-4 py-2 hover:bg-blue-600">Surat Masuk</a>
                    <a href="{{ route('admin.surat-keluar.index') }}" class="block px-4 py-2 hover:bg-blue-600">Surat Keluar</a>
                    <a href="{{ route('admin.perihal.index') }}" class="block px-4 py-2 hover:bg-blue-600">Perihal</a>
                    <a href="{{ route('admin.users.index') }}" class="block px-4 py-2 hover:bg-blue-600">Akun</a>
                    <a href="{{ route('admin.laporan.index') }}" class="block px-4 py-2 hover:bg-blue-600">Laporan</a>
                @elseif(Str::startsWith($role, 'sekolah'))
                    <a href="{{ route('sekolah.dashboard') }}" class="block px-4 py-2 hover:bg-blue-600">Dashboard</a>
                    <a href="{{ route('sekolah.surat-masuk.index') }}" class="block px-4 py-2 hover:bg-blue-600">Surat Masuk</a>
                    <a href="{{ route('sekolah.surat-keluar.index') }}" class="block px-4 py-2 hover:bg-blue-600">Surat
                        Keluar</a>
                @elseif(Str::startsWith($role, 'guru_sd'))
                    <a href="{{ route('guru_sd.dashboard') }}" class="block px-4 py-2 hover:bg-blue-600">Dashboard</a>
                    <a href="{{ route('guru_sd.surat-masuk.index') }}" class="block px-4 py-2 hover:bg-blue-600">Surat Masuk</a>
                    <a href="{{ route('guru_sd.surat-keluar.index') }}" class="block px-4 py-2 hover:bg-blue-600">Surat
                        Keluar</a>
                @elseif(Str::startsWith($role, 'guru_smp'))
                    <a href="{{ route('guru_smp.dashboard') }}" class="block px-4 py-2 hover:bg-blue-600">Dashboard</a>
                    <a href="{{ route('guru_smp.surat-masuk.index') }}" class="block px-4 py-2 hover:bg-blue-600">Surat
                        Masuk</a>
                    <a href="{{ route('guru_smp.surat-keluar.index') }}" class="block px-4 py-2 hover:bg-blue-600">Surat
                        Keluar</a>
                @elseif($role === 'korwil')
                    <a href="{{ route('korwil.dashboard') }}" class="block px-4 py-2 hover:bg-blue-600">Dashboard</a>
                    <a href="{{ route('korwil.surat-masuk.index') }}" class="block px-4 py-2 hover:bg-blue-600">Surat Masuk</a>
                    <a href="{{ route('korwil.surat-keluar.index') }}" class="block px-4 py-2 hover:bg-blue-600">Surat
                        Keluar</a>
                @endif

                {{-- Logout --}}
                <form action="{{ route('logout') }}" method="POST" class="px-4 py-2">
                    @csrf
                    <button class="w-full text-left hover:bg-red-600 px-4 py-2 rounded">Logout</button>
                </form>
            @endif
        </nav>
    </aside>

    {{-- Main Content --}}
    <main class="flex-1 p-6">
        @yield('content')
    </main>

</body>

</html>