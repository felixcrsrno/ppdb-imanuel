@php
    $errorMap = [
        404 => ['title' => 'Halaman tidak ditemukan', 'description' => 'Halaman yang Anda cari mungkin sudah dipindahkan, dihapus, atau alamatnya tidak tepat.', 'action' => 'Kembali ke beranda'],
        403 => ['title' => 'Akses tidak diizinkan', 'description' => 'Akun Anda tidak memiliki izin untuk membuka halaman ini. Silakan gunakan area kerja sesuai peran Anda.', 'action' => 'Kembali ke beranda'],
        419 => ['title' => 'Sesi telah berakhir', 'description' => 'Formulir ini sudah tidak aktif. Muat ulang halaman lalu coba lagi untuk menjaga keamanan sesi Anda.', 'action' => 'Muat ulang halaman'],
        422 => ['title' => 'Data belum dapat diproses', 'description' => 'Ada data yang perlu diperiksa kembali. Perbaiki kolom yang ditandai lalu kirim ulang formulir.', 'action' => 'Kembali ke formulir'],
        429 => ['title' => 'Terlalu banyak permintaan', 'description' => 'Sistem sedang membatasi permintaan untuk sementara. Tunggu sebentar lalu coba lagi.', 'action' => 'Coba lagi'],
        500 => ['title' => 'Terjadi kendala pada sistem', 'description' => 'Maaf, layanan sedang mengalami gangguan. Tim kami sudah menerima sinyal kesalahan ini.', 'action' => 'Kembali ke beranda'],
    ];
    $error = $errorMap[$code] ?? $errorMap[500];
    $errorTarget = in_array($code, [419, 422, 429], true) && url()->previous() !== url()->current()
        ? url()->previous()
        : route('landing');
@endphp
<!DOCTYPE html>
<html lang="id">
<head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>{{ $code }} Â· PPDB Imanuel</title>@vite(['resources/css/app.css', 'resources/js/app.js'])</head>
<body class="min-h-screen bg-[#f5f8fc] text-slate-800 antialiased">
    <main class="flex min-h-screen items-center justify-center px-4 py-12 sm:px-6">
        <section class="w-full max-w-xl text-center">
            <a href="{{ route('landing') }}" class="inline-flex items-center gap-3" aria-label="Kembali ke beranda PPDB Imanuel"><img src="{{ asset('images/logo.png') }}" alt="Logo Yayasan Imanuel Viktori" class="h-14 w-14 rounded-2xl bg-white object-contain p-1 shadow-sm"><span class="text-left"><span class="block text-sm font-extrabold tracking-wide text-primary">YPK IMANUEL VIKTORI</span><span class="block text-xs text-slate-500">Portal PPDB</span></span></a>
            <div class="mt-10 rounded-[2rem] border border-slate-200 bg-white p-8 shadow-sm sm:p-12"><div class="mx-auto flex h-20 w-20 items-center justify-center rounded-3xl bg-primary/10 text-2xl font-extrabold text-primary">{{ $code }}</div><p class="eyebrow mt-8">Status halaman</p><h1 class="mt-2 text-3xl font-bold tracking-tight text-text-navy sm:text-4xl">{{ $error['title'] }}</h1><p class="mx-auto mt-4 max-w-md text-sm leading-7 text-slate-600">{{ $error['description'] }}</p><div class="mt-8 flex flex-col gap-3 sm:flex-row sm:justify-center"><a href="{{ $errorTarget }}" class="landing-button landing-button-secondary justify-center">{{ $error['action'] }}</a>@auth<a href="{{ auth()->user()->role === 'admin' ? route('admin.dashboard') : (auth()->user()->role === 'panitia' ? route('panitia.verification.index') : route('student.dashboard')) }}" class="landing-button border border-slate-200 text-primary justify-center hover:bg-slate-50">Buka dashboard</a>@else<a href="{{ route('login') }}" class="landing-button border border-slate-200 text-primary justify-center hover:bg-slate-50">Login pendaftar</a>@endauth</div></div>
            <p class="mt-6 text-xs text-slate-400">Jika masalah berlanjut, hubungi panitia PPDB.</p>
        </section>
    </main>
</body>
</html>

