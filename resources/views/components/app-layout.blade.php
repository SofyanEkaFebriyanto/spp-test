<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'SPP Project') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#F3F4F6] text-gray-800 font-sans flex h-screen overflow-hidden">

    <!-- Sidebar -->
    <aside class="w-64 bg-[#4A6CF7] text-white flex flex-col hidden md:flex shrink-0 shadow-lg z-10">
        <div class="h-16 flex items-center px-6 font-bold text-lg border-b border-blue-400/30">
            <div class="w-8 h-8 bg-white/20 rounded mr-3 flex items-center justify-center">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
            </div>
            SPP Admin Sekolah
        </div>
        
        <nav class="flex-1 px-4 py-6 space-y-1 overflow-y-auto">
            <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-3 rounded-xl transition-all {{ request()->routeIs('dashboard') ? 'bg-white/20 font-semibold text-white' : 'text-blue-100 hover:bg-white/10 hover:text-white' }}">
                <svg class="w-5 h-5 mr-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                Dashboard
            </a>

            @if(Auth::check() && (Auth::user()->role === 'admin' || Auth::user()->role === 'petugas'))
            <a href="{{ route('pembayaran.index') }}" class="flex items-center px-4 py-3 rounded-xl transition-all {{ request()->routeIs('pembayaran.*') ? 'bg-white/20 font-semibold text-white' : 'text-blue-100 hover:bg-white/10 hover:text-white' }}">
                <svg class="w-5 h-5 mr-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                Pembayaran
            </a>
            @endif

            @if(Auth::check() && Auth::user()->role === 'admin')
            <a href="{{ route('siswa.index') }}" class="flex items-center px-4 py-3 rounded-xl transition-all {{ request()->routeIs('siswa.*') ? 'bg-white/20 font-semibold text-white' : 'text-blue-100 hover:bg-white/10 hover:text-white' }}">
                <svg class="w-5 h-5 mr-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                Data Siswa
            </a>
            <a href="{{ route('kelas.index') }}" class="flex items-center px-4 py-3 rounded-xl transition-all {{ request()->routeIs('kelas.*') ? 'bg-white/20 font-semibold text-white' : 'text-blue-100 hover:bg-white/10 hover:text-white' }}">
                <svg class="w-5 h-5 mr-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                Data Kelas
            </a>
            <a href="{{ route('spp.index') }}" class="flex items-center px-4 py-3 rounded-xl transition-all {{ request()->routeIs('spp.*') ? 'bg-white/20 font-semibold text-white' : 'text-blue-100 hover:bg-white/10 hover:text-white' }}">
                <svg class="w-5 h-5 mr-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                Data SPP
            </a>
            <a href="{{ route('user.index') }}" class="flex items-center px-4 py-3 rounded-xl transition-all {{ request()->routeIs('user.*') ? 'bg-white/20 font-semibold text-white' : 'text-blue-100 hover:bg-white/10 hover:text-white' }}">
                <svg class="w-5 h-5 mr-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                Data Petugas
            </a>
            @endif
        </nav>

        <div class="p-4 border-t border-blue-400/30">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center px-4 py-3 text-blue-100 rounded-xl hover:bg-white/10 hover:text-white transition-all">
                    <svg class="w-5 h-5 mr-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content wrapper -->
    <div class="flex-1 flex flex-col overflow-hidden">
        
        <!-- Top Navbar -->
        <header class="h-20 bg-white flex items-center px-8 border-b border-gray-200 z-0">
            <!-- Left: School Name -->
            <div class="flex-1">
                <p class="font-bold text-gray-800 text-xl tracking-tight">SMK NEGERI 7 BALEENDAH</p>
                <p class="text-sm text-gray-500 font-medium">Tahun Pelajaran 2025/2026</p>
            </div>

            <!-- Right: Avatar & Name -->
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 rounded-full bg-[#4A6CF7] text-white flex items-center justify-center font-bold text-lg shadow-sm">
                    {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                </div>
                <div class="text-sm hidden lg:block text-left">
                    <p class="font-bold text-gray-800">{{ Auth::user()->name ?? 'Admin' }}</p>
                    <p class="text-xs text-gray-500 font-medium capitalize">{{ Auth::user()->role ?? 'Administrator' }}</p>
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-[#F3F4F6] p-8">
            {{ $slot }}
        </main>
    </div>

    @stack('modals')
</body>
</html>
