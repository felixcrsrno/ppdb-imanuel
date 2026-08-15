@extends('layouts.app')

@section('content')
<div class="py-8 bg-slate-50/50 min-h-screen">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 space-y-8">
        <!-- HEADER PAGE & ACTION -->
        <x-card class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <div class="flex items-center gap-2">
                    <span class="inline-flex items-center rounded-md bg-primary/10 px-2 py-1 text-xs font-semibold text-primary">Panel Administrator</span>
                </div>
                <h1 class="text-2xl sm:text-3xl font-extrabold text-text-navy tracking-tight mt-1">Dashboard Admin</h1>
                <p class="text-sm text-slate-600 mt-0.5">Pantau pendaftaran, verifikasi, dan aktivitas PPDB Yayasan Imanuel.</p>
            </div>

            <div class="flex items-center gap-3">
                <x-button as="a" href="{{ route('admin.reports.export') }}" class="inline-flex items-center gap-2" variant="primary"> 
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Ekspor Laporan
                </x-button>
            </div>
        </x-card>

        <!-- STATISTIK Utama -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <x-card class="p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-semibold tracking-wider text-slate-400 uppercase">Total Pendaftar</p>
                        <h3 class="text-3xl sm:text-4xl font-extrabold text-text-navy mt-2">{{ $totalPendaftar }}</h3>
                    </div>
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-primary/10 text-primary">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                </div>
                <div class="mt-4 pt-4 border-t border-slate-50 flex items-center justify-between text-xs text-slate-500">
                    <span>Semua Gelombang</span>
                    <span class="text-emerald-600 font-bold flex items-center gap-1">
                        â— Sistem Aktif
                    </span>
                </div>
            </x-card>

            <x-card class="p-6">
                <div class="flex items-center justify-between mb-3">
                    <p class="text-xs font-semibold tracking-wider text-slate-400 uppercase">Pendaftar per Jenjang</p>
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-amber-50 text-amber-600">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0112 20.055a11.952 11.952 0 01-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                        </svg>
                    </div>
                </div>
                <div class="space-y-2">
                    <div class="flex items-center justify-between p-2 rounded-xl bg-slate-50">
                        <span class="text-xs font-bold text-slate-700">TK Imanuel</span>
                        <span class="text-xs font-extrabold text-slate-900 bg-white px-2.5 py-1 rounded-lg border border-slate-200">{{ $tkCount ?? 0 }}</span>
                    </div>
                    <div class="flex items-center justify-between p-2 rounded-xl bg-blue-50/50">
                        <span class="text-xs font-bold text-blue-900">SD Imanuel</span>
                        <span class="text-xs font-extrabold text-blue-950 bg-white px-2.5 py-1 rounded-lg border border-blue-100">{{ $sdCount ?? 0 }}</span>
                    </div>
                    <div class="flex items-center justify-between p-2 rounded-xl bg-slate-50">
                        <span class="text-xs font-bold text-slate-700">SMP Imanuel</span>
                        <span class="text-xs font-extrabold text-slate-900 bg-white px-2.5 py-1 rounded-lg border border-slate-200">{{ $smpCount ?? 0 }}</span>
                    </div>
                </div>
            </x-card>

            <x-card class="p-6">
                <div class="flex items-center justify-between mb-3">
                    <p class="text-xs font-semibold tracking-wider text-slate-400 uppercase">Status Pendaftaran</p>
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
                <div class="space-y-2">
                    <div class="flex items-center justify-between p-2 rounded-xl bg-amber-50/60">
                        <span class="text-xs font-bold text-amber-800 flex items-center gap-1.5">
                            <span class="h-2 w-2 rounded-full bg-amber-500"></span> Pending / Menunggu
                        </span>
                        <span class="text-xs font-extrabold text-amber-950 bg-white px-2.5 py-1 rounded-lg border border-amber-200">{{ $pendingCount ?? 0 }}</span>
                    </div>
                    <div class="flex items-center justify-between p-2 rounded-xl bg-emerald-50/60">
                        <span class="text-xs font-bold text-emerald-800 flex items-center gap-1.5">
                            <span class="h-2 w-2 rounded-full bg-emerald-500"></span> Terverifikasi
                        </span>
                        <span class="text-xs font-extrabold text-emerald-950 bg-white px-2.5 py-1 rounded-lg border border-emerald-200">{{ $verifiedCount ?? 0 }}</span>
                    </div>
                    <div class="flex items-center justify-between p-2 rounded-xl bg-rose-50/60">
                        <span class="text-xs font-bold text-rose-800 flex items-center gap-1.5">
                            <span class="h-2 w-2 rounded-full bg-rose-500"></span> Ditolak
                        </span>
                        <span class="text-xs font-extrabold text-rose-950 bg-white px-2.5 py-1 rounded-lg border border-rose-200">{{ $rejectedCount ?? 0 }}</span>
                    </div>
                </div>
            </x-card>

        </div>

        <!-- TABEL PENDAFTAR TERBARU -->
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
            <div class="p-6 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h3 class="text-base font-bold text-slate-900">Data Pendaftar Terbaru</h3>
                    <p class="text-xs text-slate-500 mt-0.5">Daftar calon siswa yang baru mendaftar di sistem PPDB.</p>
                </div>
                <a href="{{ Route::has('panitia.verification.index') ? route('panitia.verification.index') : '#' }}" class="text-xs font-bold text-blue-900 hover:text-blue-700 flex items-center gap-1">
                    Lihat Semua Verifikasi
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs sm:text-sm text-slate-600">
                    <thead class="bg-slate-50 text-slate-400 uppercase text-[10px] tracking-wider font-extrabold border-b border-slate-100">
                        <tr>
                            <th class="px-6 py-3.5">Kode / Nama Siswa</th>
                            <th class="px-6 py-3.5">Jenjang</th>
                            <th class="px-6 py-3.5">Tanggal Daftar</th>
                            <th class="px-6 py-3.5">Status</th>
                            <th class="px-6 py-3.5 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($recentStudents as $student)
                            <tr class="hover:bg-slate-50/80 transition">
                                <td class="px-6 py-4 font-semibold text-slate-900">
                                    <div class="font-bold text-slate-900">{{ $student->registration?->studentProfile?->full_name ?? $student->name }}</div>
                                    <div class="text-[11px] text-slate-400">{{ $student->email }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center rounded-lg bg-blue-50 px-2.5 py-1 text-xs font-bold text-blue-900 border border-blue-100">
                                        {{ $student->registration?->unit ?? 'Belum dipilih' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-slate-500 text-xs">
                                    {{ $student->created_at->format('d M Y, H:i') }}
                                </td>
                                <td class="px-6 py-4">
                                    @if(($student->registration?->status ?? 'draft') === 'draft')
                                        <span class="inline-flex items-center gap-1 rounded-full bg-slate-100 px-2.5 py-1 text-xs font-bold text-slate-600 border border-slate-200">
                                            <span class="h-1.5 w-1.5 rounded-full bg-slate-400"></span> Belum isi biodata
                                        </span>
                                    @elseif($student->registration?->status === 'pending')
                                        <span class="inline-flex items-center gap-1 rounded-full bg-amber-50 px-2.5 py-1 text-xs font-bold text-amber-700 border border-amber-200">
                                            <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span> Pending
                                        </span>
                                    @elseif(($student->registration?->status ?? 'draft') === 'verified')
                                        <span class="inline-flex items-center gap-1 rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-bold text-emerald-700 border border-emerald-200">
                                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span> Terverifikasi
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 rounded-full bg-rose-50 px-2.5 py-1 text-xs font-bold text-rose-700 border border-rose-200">
                                            <span class="h-1.5 w-1.5 rounded-full bg-rose-500"></span> Ditolak
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right">
                                    @if($student->registration)
                                        <a href="{{ route('panitia.verification.show', $student->registration->id) }}" class="rounded-lg bg-slate-100 px-3 py-1.5 text-xs font-bold text-slate-700 hover:bg-blue-900 hover:text-white transition">Detail</a>
                                    @else
                                        <span class="text-xs text-slate-400">Menunggu biodata</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5"><x-empty-state icon="users" title="Belum ada pendaftar" description="Pendaftar baru akan muncul di sini setelah membuat akun dan mengisi proses awal." /></td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
@endsection

