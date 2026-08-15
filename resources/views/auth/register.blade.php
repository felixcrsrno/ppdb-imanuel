@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-xl rounded-3xl bg-white p-8 shadow-sm">
    <h1 class="text-3xl font-semibold text-slate-900">Daftar Akun Baru</h1>
    <p class="mt-3 text-slate-600">Buat akun pendaftar untuk memulai proses PPDB secara online.</p>

    <form action="{{ route('register.post') }}" method="POST" class="mt-8 space-y-6">
        @csrf

        <div>
            <label class="block text-sm font-medium text-slate-700">Nama Lengkap</label>
            <input type="text" name="name" value="{{ old('name') }}" required class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3 text-slate-900 outline-none focus:border-slate-900" />
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-700">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3 text-slate-900 outline-none focus:border-slate-900" />
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-700">Kata Sandi</label>
            <input type="password" name="password" required class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3 text-slate-900 outline-none focus:border-slate-900" />
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-700">Konfirmasi Kata Sandi</label>
            <input type="password" name="password_confirmation" required class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3 text-slate-900 outline-none focus:border-slate-900" />
        </div>

        <button type="submit" class="w-full rounded-2xl bg-slate-900 px-4 py-3 text-sm font-semibold text-white hover:bg-slate-700">Daftar</button>
    </form>

    <p class="mt-6 text-sm text-slate-600">Sudah punya akun? <a href="{{ route('login') }}" class="font-semibold text-slate-900">Masuk di sini</a>.</p>
</div>
@endsection

