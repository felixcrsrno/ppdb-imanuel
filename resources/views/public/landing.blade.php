@extends('layouts.app')

@section('content')
<div class="landing-page overflow-hidden bg-[#f5f8fc] text-slate-800">
    <section class="landing-hero relative isolate bg-[#0b2850] text-white">
        <div class="hero-orb hero-orb-one"></div><div class="hero-orb hero-orb-two"></div>
        <div class="relative mx-auto grid max-w-7xl items-center gap-12 px-4 py-20 sm:px-6 lg:grid-cols-[1.05fr_.95fr] lg:px-8 lg:py-28">
            <div class="max-w-2xl">
                <p class="eyebrow text-sky-200">PPDB 2026/2027 Â· YPK Imanuel Viktori</p>
                <h1 class="mt-5 text-4xl font-bold tracking-tight sm:text-5xl lg:text-6xl">Selamat Datang di PPDB<br><span class="text-sky-300">Yayasan Imanuel Viktori</span></h1>
                <p class="mt-6 max-w-xl text-base leading-7 text-blue-100 sm:text-lg">Membuka langkah pertama menuju pendidikan yang berkarakter, beriman, dan berprestasi. Daftar dengan mudah, pantau prosesnya, dan dapatkan informasi dalam satu tempat.</p>
                <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                    <a href="{{ route('register') }}" class="landing-button landing-button-primary justify-center">Daftar Sekarang <span aria-hidden="true">â†’</span></a>
                    <a href="{{ route('login') }}" class="landing-button landing-button-ghost justify-center">Login Pendaftar</a>
                </div>
                <div class="mt-8 flex flex-wrap gap-x-6 gap-y-2 text-sm text-blue-100"><span>âœ“ Proses online</span><span>âœ“ Transparan</span><span>âœ“ Dukungan panitia</span></div>
            </div>
            <div class="relative hidden min-h-[360px] lg:block" aria-label="Ilustrasi pendidikan">
                <div class="absolute inset-8 rounded-[2.5rem] border border-white/15 bg-white/10 backdrop-blur-sm"></div>
                <div class="absolute left-16 top-14 h-64 w-72 rounded-3xl bg-white p-6 text-slate-800 shadow-2xl rotate-[-4deg]">
                    <div class="flex items-center justify-between"><span class="text-xs font-bold uppercase tracking-widest text-primary">PPDB Online</span><span class="rounded-full bg-emerald-50 px-2 py-1 text-[10px] font-bold text-emerald-700">Terbuka</span></div>
                    <div class="mt-8 h-3 w-32 rounded bg-slate-200"></div><div class="mt-3 h-3 w-48 rounded bg-slate-100"></div>
                    <div class="mt-8 space-y-3"><div class="h-10 rounded-xl bg-sky-50"></div><div class="h-10 rounded-xl bg-amber-50"></div><div class="h-10 rounded-xl bg-emerald-50"></div></div>
                </div>
                <div class="absolute bottom-12 right-8 rounded-2xl border border-white/30 bg-white/95 p-4 text-slate-800 shadow-xl"><p class="text-2xl font-bold text-primary">TK Â· SD Â· SMP</p><p class="mt-1 text-xs text-slate-500">Satu yayasan, satu langkah awal</p></div>
            </div>
        </div>
    </section>

    <section id="jenjang" class="landing-section">
        <div class="landing-container"><div class="section-heading"><p class="eyebrow">Jenjang Pendidikan</p><h2>Pendidikan yang tumbuh bersama anak</h2><p>Lingkungan belajar yang aman dan hangat untuk setiap tahap perkembangan.</p></div>
            <div class="grid gap-5 md:grid-cols-3">
                @foreach([['TK','Taman Kanak-kanak','Fondasi karakter dan kreativitas melalui belajar sambil bermain.','bg-rose-50 text-rose-700'],['SD','Sekolah Dasar','Membangun rasa ingin tahu, kemandirian, dan prestasi akademik.','bg-sky-50 text-sky-700'],['SMP','Sekolah Menengah Pertama','Mempersiapkan remaja menghadapi masa depan dengan percaya diri.','bg-indigo-50 text-indigo-700']] as $level)
                    <article class="card group p-6"><div class="flex items-center justify-between"><span class="flex h-12 w-12 items-center justify-center rounded-2xl text-lg font-bold {{ $level[3] }}">{{ $level[0] }}</span><span class="text-xs font-semibold text-slate-400">IMANUEL VIKTORI</span></div><h3 class="mt-7 text-xl font-bold text-slate-900">{{ $level[1] }}</h3><p class="mt-3 text-sm leading-6 text-slate-600">{{ $level[2] }}</p><a href="{{ route('register') }}" class="mt-6 inline-flex items-center gap-2 text-sm font-bold text-primary">Pilih jenjang <span aria-hidden="true">â†’</span></a></article>
                @endforeach
            </div>
        </div>
    </section>

    <section id="alur" class="landing-section bg-white"><div class="landing-container"><div class="section-heading"><p class="eyebrow">Alur Pendaftaran</p><h2>Empat langkah, satu tujuan</h2><p>Seluruh proses dapat dilakukan secara online dari rumah.</p></div><div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
        @foreach([['01','Buat akun','Daftarkan email orang tua atau wali.'],['02','Isi biodata','Lengkapi data calon siswa dan pilih jenjang.'],['03','Unggah berkas','Kirim dokumen persyaratan dengan aman.'],['04','Pantau hasil','Cek verifikasi dan pengumuman di dashboard.']] as $step)<div class="relative rounded-2xl border border-slate-200 bg-[#f8fafc] p-6"><span class="text-sm font-bold text-primary">{{ $step[0] }}</span><h3 class="mt-8 font-bold text-slate-900">{{ $step[1] }}</h3><p class="mt-2 text-sm leading-6 text-slate-600">{{ $step[2] }}</p></div>@endforeach
    </div></div></section>

    <section id="jadwal" class="landing-section"><div class="landing-container"><div class="grid gap-10 lg:grid-cols-[.75fr_1.25fr] lg:items-start"><div><p class="eyebrow">Jadwal</p><h2 class="mt-3 text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl">Catat tanggal pentingnya</h2><p class="mt-4 leading-7 text-slate-600">Ikuti setiap tahapan agar proses pendaftaran berjalan lancar.</p><a href="{{ route('register') }}" class="landing-button landing-button-secondary mt-7">Daftar sekarang</a></div><div class="card divide-y divide-slate-100 p-0">
        @foreach([['Pendaftaran online','1 Juni â€“ 31 Juli 2026','bg-sky-100 text-sky-700'],['Verifikasi berkas','1 â€“ 10 Agustus 2026','bg-amber-100 text-amber-700'],['Pengumuman hasil','15 Agustus 2026','bg-emerald-100 text-emerald-700'],['Daftar ulang','16 â€“ 31 Agustus 2026','bg-indigo-100 text-indigo-700']] as $item)<div class="flex flex-col gap-2 p-5 sm:flex-row sm:items-center sm:justify-between"><div class="flex items-center gap-3"><span class="h-3 w-3 rounded-full {{ $item[2] }}" aria-hidden="true"></span><span class="font-semibold text-slate-800">{{ $item[0] }}</span></div><span class="text-sm text-slate-500 sm:pl-6">{{ $item[1] }}</span></div>@endforeach
    </div></div></div></section>

    <section id="persyaratan" class="landing-section bg-white"><div class="landing-container"><div class="section-heading"><p class="eyebrow">Persyaratan</p><h2>Siapkan dokumen berikut</h2><p>Dokumen yang jelas akan membantu proses verifikasi lebih cepat.</p></div><div class="grid gap-4 md:grid-cols-2 lg:grid-cols-4">@foreach(['Kartu Keluarga','Akta Kelahiran','Pas foto terbaru','Rapor / ijazah'] as $requirement)<div class="flex items-center gap-3 rounded-2xl border border-slate-200 p-5"><span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-emerald-50 font-bold text-emerald-700" aria-hidden="true">âœ“</span><span class="font-semibold text-slate-800">{{ $requirement }}</span></div>@endforeach</div></div></section>

    <section id="faq" class="landing-section"><div class="landing-container max-w-4xl"><div class="section-heading"><p class="eyebrow">FAQ</p><h2>Pertanyaan yang sering ditanyakan</h2></div><div class="space-y-3" x-data="{ open: null }">@foreach([['Apakah pendaftaran harus datang ke sekolah?','Tidak. Pendaftaran dan unggah berkas dapat dilakukan secara online. Panitia akan menghubungi Anda bila diperlukan verifikasi lanjutan.'],['Bagaimana cara memantau status pendaftaran?','Login ke dashboard pendaftar untuk melihat kelengkapan biodata, berkas, dan status verifikasi secara berkala.'],['Apa yang harus dilakukan jika ada kendala?','Hubungi panitia melalui kontak yang tersedia di bagian bawah halaman. Kami siap membantu pada jam layanan.']] as $index => $faq)<div class="rounded-2xl border border-slate-200 bg-white"><button type="button" class="flex w-full items-center justify-between gap-4 p-5 text-left font-semibold text-slate-900" @click="open = open === {{ $index }} ? null : {{ $index }}" :aria-expanded="open === {{ $index }}"><span>{{ $faq[0] }}</span><span class="text-xl text-primary" aria-hidden="true" x-text="open === {{ $index }} ? 'âˆ’' : '+'"></span></button><div x-show="open === {{ $index }}" x-transition x-cloak class="px-5 pb-5 text-sm leading-6 text-slate-600">{{ $faq[1] }}</div></div>@endforeach</div></div></section>

    <section id="yayasan" class="landing-section bg-[#eaf2fb]"><div class="landing-container grid gap-8 lg:grid-cols-[1.2fr_.8fr] lg:items-center"><div><p class="eyebrow">Informasi Yayasan</p><h2 class="mt-3 text-3xl font-bold tracking-tight text-slate-900">Mendidik dengan iman, melayani dengan kasih</h2><p class="mt-4 max-w-2xl leading-7 text-slate-600">Yayasan Imanuel Viktori hadir untuk mendampingi keluarga melalui pendidikan yang menyeluruh. Kami percaya setiap anak memiliki potensi unik untuk bertumbuh dan memberi dampak baik.</p></div><div id="kontak" class="rounded-3xl bg-white p-6 shadow-sm"><p class="font-bold text-slate-900">Kontak PPDB</p><div class="mt-4 space-y-3 text-sm text-slate-600"><p>Jl. Raya Pondok Gede No. 1, Bekasi Barat</p><p><a class="font-semibold text-primary hover:underline" href="tel:+6221848888562">(021) 848888562</a></p><p><a class="font-semibold text-primary hover:underline" href="mailto:ppdb@imanuelpondokgede.sch.id">ppdb@imanuelpondokgede.sch.id</a></p><p>Seninâ€“Jumat, 08.00â€“15.00 WIB</p></div></div></div></section>

    <footer class="bg-[#0b2850] text-blue-100"><div class="landing-container flex flex-col gap-5 py-10 sm:flex-row sm:items-center sm:justify-between"><div class="flex items-center gap-3"><img src="{{ asset('images/logo.png') }}" alt="Logo Yayasan Imanuel Viktori" class="h-11 w-11 rounded-xl bg-white object-contain p-1"><div><p class="font-bold text-white">Yayasan Imanuel Viktori</p><p class="text-xs text-blue-200">TK Â· SD Â· SMP</p></div></div><p class="text-sm text-blue-200">Â© {{ date('Y') }} Hak cipta dilindungi.</p></div></footer>
</div>
@endsection

