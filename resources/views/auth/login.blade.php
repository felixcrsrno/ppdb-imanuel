@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-xl rounded-3xl bg-white p-8 shadow-sm">
    <h1 class="text-3xl font-semibold text-slate-900">Masuk</h1>
    <p class="mt-3 text-slate-600">Masuk untuk mengelola pendaftaran atau memantau status PPDB Anda.</p>

    <form action="{{ route('login.post') }}" method="POST" class="mt-8 space-y-6">
        @csrf

        <div>
            <label class="block text-sm font-medium text-slate-700">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required autofocus class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3 text-slate-900 outline-none focus:border-slate-900" />
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-700">Kata Sandi</label>
            <input type="password" name="password" required class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3 text-slate-900 outline-none focus:border-slate-900" />
        </div>

        <div class="flex items-center justify-between">
            <label class="inline-flex items-center gap-2 text-sm text-slate-700">
                <input type="checkbox" name="remember" class="h-4 w-4 rounded border-slate-300 text-slate-900 focus:ring-slate-900" />
                Ingat saya
            </label>
        </div>

        <button type="submit" class="w-full rounded-2xl bg-slate-900 px-4 py-3 text-sm font-semibold text-white hover:bg-slate-700">Masuk</button>
    </form>

    <p class="mt-6 text-sm text-slate-600">Belum punya akun? <a href="{{ route('register') }}" class="font-semibold text-slate-900">Daftar sekarang</a>.</p>
</div>
@endsection

