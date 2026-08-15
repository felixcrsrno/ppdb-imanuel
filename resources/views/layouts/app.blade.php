<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'PPDB Yayasan Imanuel') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="min-h-screen text-slate-900 antialiased flex flex-col justify-between">

    <!-- NAVBAR / HEADER -->
    <header x-data="{ mobileMenuOpen: false, logoutOpen: false }" class="sticky top-0 z-50 border-b border-slate-200/80 bg-white/95 backdrop-blur-md">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-3 sm:px-6 lg:px-8">
            
            <!-- Logo Brand -->
            <a href="{{ route('landing') }}" class="flex items-center gap-3 group">
                <img src="{{ asset('images/logo.png') }}" alt="Logo YPK Imanuel Viktori" class="h-11 w-11 object-contain transition group-hover:scale-105" />
                <div>
                    <span class="block text-sm font-extrabold tracking-wider text-slate-900 uppercase leading-tight">YPK IMANUEL VIKTORI</span>
                    <span class="block text-[10px] font-semibold text-slate-500 leading-none">Pondok Melati â€¢ TK â€“ SD â€“ SMP</span>
                </div>
            </a>

            <!-- Navigasi Menu Tengah (Desktop) -->
            <nav class="hidden md:flex items-center gap-1 text-sm font-semibold text-slate-600">
                @auth
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="py-2 px-3 rounded-md transition {{ request()->routeIs('admin.dashboard') ? 'text-primary bg-primary/10' : 'hover:text-primary' }}">Dashboard</a>
                        <a href="{{ route('panitia.verification.index') }}" class="py-2 px-3 rounded-md transition {{ request()->is('panitia/*') ? 'text-primary bg-primary/10' : 'hover:text-primary' }}">Pendaftar &amp; Verifikasi</a>
                        <a href="{{ route('admin.reports.export') }}" class="py-2 px-3 rounded-md transition hover:text-primary">Laporan</a>
                    @elseif(auth()->user()->role === 'panitia')
                        <a href="{{ route('panitia.verification.index') }}" class="py-2 px-3 rounded-md transition text-primary bg-primary/10">Pendaftar &amp; Verifikasi</a>
                    @else
                        <a href="{{ route('student.dashboard') }}" class="py-2 px-3 rounded-md transition text-primary bg-primary/10">Dashboard Pendaftar</a>
                        <a href="{{ route('landing') }}#alur" class="py-2 px-3 rounded-md transition hover:text-primary">Panduan PPDB</a>
                    @endif
                @else
                    <a href="{{ route('landing') }}" class="py-2 px-3 rounded-md transition {{ request()->routeIs('landing') ? 'text-primary bg-primary/10' : 'hover:text-primary' }}">Beranda</a>
                    <a href="{{ route('landing') }}#jenjang" class="py-2 px-3 rounded-md transition hover:text-primary">Jenjang</a>
                    <a href="{{ route('landing') }}#alur" class="py-2 px-3 rounded-md transition hover:text-primary">Alur Pendaftaran</a>
                    <a href="{{ route('landing') }}#jadwal" class="py-2 px-3 rounded-md transition hover:text-primary">Jadwal</a>
                    <a href="{{ route('landing') }}#persyaratan" class="py-2 px-3 rounded-md transition hover:text-primary">Persyaratan</a>
                    <a href="{{ route('landing') }}#faq" class="py-2 px-3 rounded-md transition hover:text-primary">FAQ</a>
                @endauth
            </nav>

            <!-- Tombol Aksi / Auth (Desktop) -->
            <div class="hidden md:flex items-center space-x-3">
                @auth
                    @if(auth()->user()->role === 'pendaftar')
                        <a href="{{ route('student.dashboard') }}" class="rounded-xl bg-primary px-4 py-2 text-xs sm:text-sm font-semibold text-white shadow-sm hover:bg-primary-dark">Dashboard</a>
                    @elseif(auth()->user()->role === 'panitia')
                        <a href="{{ route('panitia.verification.index') }}" class="rounded-xl bg-primary px-4 py-2 text-xs sm:text-sm font-semibold text-white shadow-sm hover:bg-primary-dark">Verifikasi</a>
                    @else
                        <a href="{{ route('admin.dashboard') }}" class="rounded-xl bg-primary px-4 py-2 text-xs sm:text-sm font-semibold text-white shadow-sm hover:bg-primary-dark">Admin Panel</a>
                    @endif
                    <button type="button" @click="logoutOpen = true" class="rounded-xl border border-slate-200 px-4 py-2 text-xs sm:text-sm font-semibold text-slate-700 hover:bg-slate-50">Keluar</button>
                @else
                    <a href="{{ route('login') }}" class="rounded-full border border-primary px-5 py-2 text-xs sm:text-sm font-bold text-primary hover:bg-primary/10 transition">Masuk</a>
                    @if(Route::has('register'))
                        <a href="{{ route('register') }}" class="rounded-full bg-amber-500 px-5 py-2 text-xs sm:text-sm font-bold text-slate-950 shadow hover:bg-amber-400 transition">Daftar Baru</a>
                    @endif
                @endauth
            </div>

            <!-- Tombol Hamburger Mobile -->
            <button @click="mobileMenuOpen = !mobileMenuOpen" type="button" class="md:hidden rounded-lg p-2 text-slate-600 hover:bg-slate-100 focus:outline-none" aria-label="Toggle Navigation">
                <svg class="h-6 w-6" x-show="!mobileMenuOpen" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <svg class="h-6 w-6" x-show="mobileMenuOpen" x-cloak fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Mobile Menu Drawer (Tampil Saat Layar Kecil) -->
        <div x-show="mobileMenuOpen" x-cloak class="md:hidden border-t border-slate-100 bg-white px-4 pt-3 pb-6 space-y-4 shadow-lg">
            <nav class="flex flex-col space-y-3 text-sm font-semibold text-slate-600">
                @auth
                    @if(auth()->user()->role === 'admin')
                        <a @click="mobileMenuOpen = false" href="{{ route('admin.dashboard') }}" class="py-2 px-3 rounded-md transition hover:text-primary">Dashboard</a>
                        <a @click="mobileMenuOpen = false" href="{{ route('panitia.verification.index') }}" class="py-2 px-3 rounded-md transition hover:text-primary">Pendaftar &amp; Verifikasi</a>
                        <a @click="mobileMenuOpen = false" href="{{ route('admin.reports.export') }}" class="py-2 px-3 rounded-md transition hover:text-primary">Laporan</a>
                    @elseif(auth()->user()->role === 'panitia')
                        <a @click="mobileMenuOpen = false" href="{{ route('panitia.verification.index') }}" class="py-2 px-3 rounded-md transition text-primary bg-primary/10">Pendaftar &amp; Verifikasi</a>
                    @else
                        <a @click="mobileMenuOpen = false" href="{{ route('student.dashboard') }}" class="py-2 px-3 rounded-md transition text-primary bg-primary/10">Dashboard Pendaftar</a>
                        <a @click="mobileMenuOpen = false" href="{{ route('landing') }}#alur" class="py-2 px-3 rounded-md transition hover:text-primary">Panduan PPDB</a>
                    @endif
                @else
                    <a @click="mobileMenuOpen = false" href="{{ route('landing') }}" class="py-2 px-3 rounded-md transition {{ request()->routeIs('landing') ? 'text-primary bg-primary/10' : 'hover:text-primary' }}">Beranda</a>
                    <a @click="mobileMenuOpen = false" href="{{ route('landing') }}#jenjang" class="py-2 px-3 rounded-md transition hover:text-primary">Jenjang</a>
                    <a @click="mobileMenuOpen = false" href="{{ route('landing') }}#alur" class="py-2 px-3 rounded-md transition hover:text-primary">Alur Pendaftaran</a>
                    <a @click="mobileMenuOpen = false" href="{{ route('landing') }}#jadwal" class="py-2 px-3 rounded-md transition hover:text-primary">Jadwal</a>
                    <a @click="mobileMenuOpen = false" href="{{ route('landing') }}#persyaratan" class="py-2 px-3 rounded-md transition hover:text-primary">Persyaratan</a>
                    <a @click="mobileMenuOpen = false" href="{{ route('landing') }}#faq" class="py-2 px-3 rounded-md transition hover:text-primary">FAQ</a>
                @endauth
            </nav>
            <hr class="border-slate-100">
            <div class="flex flex-col space-y-2">
                @auth
                    @if(auth()->user()->role === 'pendaftar')
                        <a href="{{ route('student.dashboard') }}" class="text-center rounded-xl bg-primary py-2.5 text-xs font-semibold text-white shadow">Dashboard</a>
                    @elseif(auth()->user()->role === 'panitia')
                        <a href="{{ route('panitia.verification.index') }}" class="text-center rounded-xl bg-primary py-2.5 text-xs font-semibold text-white shadow">Verifikasi</a>
                    @else
                        <a href="{{ route('admin.dashboard') }}" class="text-center rounded-xl bg-primary py-2.5 text-xs font-semibold text-white shadow">Admin Panel</a>
                    @endif
                        <button type="button" @click="logoutOpen = true; mobileMenuOpen = false" class="w-full rounded-xl border border-slate-300 py-2.5 text-xs font-semibold text-slate-700 hover:bg-slate-100">Keluar</button>
                @else
                    <a href="{{ route('login') }}" class="text-center rounded-xl border border-blue-900 py-2.5 text-xs font-bold text-blue-900">Masuk</a>
                    @if(Route::has('register'))
                        <a href="{{ route('register') }}" class="text-center rounded-xl bg-amber-500 py-2.5 text-xs font-bold text-slate-950 shadow">Daftar Baru</a>
                    @endif
                @endauth
            </div>
        </div>

        @auth
            <form id="logout-form" method="POST" action="{{ route('logout') }}" class="hidden">@csrf</form>
            <x-modal open="logoutOpen" title="Keluar dari akun?" description="Anda akan keluar dari sesi PPDB Imanuel di perangkat ini." consequence="Pastikan semua perubahan data sudah tersimpan sebelum keluar." confirm-text="Ya, keluar" confirm-action="document.getElementById('logout-form').submit()" />
        @endauth
    </header>

    <!-- MAIN CONTENT CONTAINER -->
    <main class="w-full flex-grow">
        <!-- Notification system: flash messages remain server-backed; no browser alerts. -->
        @php
            $flashNotifications = collect([
                ['type' => 'success', 'message' => session('success')],
                ['type' => 'warning', 'message' => session('warning')],
                ['type' => 'error', 'message' => session('error')],
                ['type' => 'info', 'message' => session('info')],
            ])->filter(fn ($notification) => filled($notification['message']));
        @endphp
        @if($flashNotifications->isNotEmpty())
            <div x-data="{ open: true }" x-show="open" x-transition class="fixed right-4 top-20 z-[70] w-[calc(100%-2rem)] max-w-sm space-y-3" aria-live="polite">
                @foreach($flashNotifications as $notification)
                    @php $noticeStyle = ['success' => 'border-emerald-200 bg-emerald-50 text-emerald-900', 'warning' => 'border-amber-200 bg-amber-50 text-amber-900', 'error' => 'border-rose-200 bg-rose-50 text-rose-900', 'info' => 'border-blue-200 bg-blue-50 text-blue-900'][$notification['type']]; @endphp
                    <div class="flex items-start gap-3 rounded-2xl border p-4 text-sm shadow-lg {{ $noticeStyle }}"><span class="mt-0.5 text-base">{{ ['success' => 'âœ“', 'warning' => '!', 'error' => 'Ã—', 'info' => 'i'][$notification['type']] }}</span><p class="flex-1 leading-5">{{ $notification['message'] }}</p><button type="button" @click="open = false" class="text-lg leading-none opacity-60 hover:opacity-100" aria-label="Tutup notifikasi">Ã—</button></div>
                @endforeach
            </div>
        @endif

        @if($errors->any())
            <div class="mx-auto max-w-7xl px-4 pt-6 sm:px-6 lg:px-8">
                <div class="rounded-2xl border border-rose-200 bg-rose-50 p-4 text-sm text-rose-900 shadow-sm" role="alert"><p class="font-bold">Terjadi beberapa kesalahan:</p><ul class="mt-2 list-disc space-y-1 pl-5">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
            </div>
        @endif

        @yield('content')
    </main>

</body>
</html>

