@extends('layouts.app')

@section('content')
@php
    $statusMeta = [
        'pending' => ['label' => 'Menunggu', 'class' => 'bg-amber-50 text-amber-700 ring-amber-200', 'dot' => 'bg-amber-500'],
        'verified' => ['label' => 'Terverifikasi', 'class' => 'bg-emerald-50 text-emerald-700 ring-emerald-200', 'dot' => 'bg-emerald-500'],
        'passed' => ['label' => 'Diterima', 'class' => 'bg-blue-50 text-blue-700 ring-blue-200', 'dot' => 'bg-blue-500'],
        'rejected' => ['label' => 'Ditolak', 'class' => 'bg-rose-50 text-rose-700 ring-rose-200', 'dot' => 'bg-rose-500'],
        'failed' => ['label' => 'Ditolak', 'class' => 'bg-rose-50 text-rose-700 ring-rose-200', 'dot' => 'bg-rose-500'],
        'draft' => ['label' => 'Menunggu', 'class' => 'bg-slate-100 text-slate-600 ring-slate-200', 'dot' => 'bg-slate-400'],
    ];
@endphp

<div class="page-shell mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
    <section class="mb-6 flex flex-col gap-5 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <p class="eyebrow">Ruang kerja panitia</p>
            <h1 class="mt-2 text-3xl font-bold tracking-tight text-text-navy">Verifikasi Pendaftaran</h1>
            <p class="mt-2 max-w-2xl text-sm text-slate-500">Periksa kelengkapan data dan berkas calon peserta didik dengan cepat dan terstruktur.</p>
        </div>
        <div class="text-left text-xs text-slate-500 sm:text-right">
            <p>Gelombang <span class="font-semibold text-slate-700">{{ $currentBatch ?? 'Umum' }}</span></p>
            <p class="mt-1">Diperbarui {{ $lastUpdated ?? '-' }}</p>
        </div>
    </section>

    <div class="mb-6 grid gap-3 sm:grid-cols-2 lg:grid-cols-5">
        @foreach([
            ['label' => 'Total pendaftar', 'value' => $stats['total'] ?? 0, 'tone' => 'text-text-navy'],
            ['label' => 'Menunggu', 'value' => $stats['pending'] ?? 0, 'tone' => 'text-amber-600'],
            ['label' => 'Terverifikasi', 'value' => $stats['verified'] ?? 0, 'tone' => 'text-emerald-600'],
            ['label' => 'Diterima', 'value' => $stats['accepted'] ?? 0, 'tone' => 'text-blue-600'],
            ['label' => 'Ditolak', 'value' => $stats['rejected'] ?? 0, 'tone' => 'text-rose-600'],
        ] as $stat)
            <div class="card px-4 py-4">
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">{{ $stat['label'] }}</p>
                <p class="mt-2 text-2xl font-bold {{ $stat['tone'] }}">{{ $stat['value'] }}</p>
            </div>
        @endforeach
    </div>

    <section class="card overflow-hidden">
        <div class="border-b border-slate-100 px-5 py-5 sm:px-6">
            <div class="flex flex-col gap-1 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h2 class="font-bold text-text-navy">Daftar pendaftar</h2>
                    <p class="mt-1 text-xs text-slate-500">Gunakan filter untuk menemukan pendaftaran tertentu.</p>
                </div>
                <span class="text-xs text-slate-400">{{ $registrations->total() }} data</span>
            </div>
            <form method="GET" action="{{ route('panitia.verification.index') }}" class="mt-5 grid gap-3 md:grid-cols-2 xl:grid-cols-5">
                <label class="relative md:col-span-2 xl:col-span-2">
                    <span class="sr-only">Cari nama atau kode registrasi</span>
                    <svg class="pointer-events-none absolute left-3 top-3 h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="m21 21-4.35-4.35m1.35-5.65a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"/></svg>
                    <input name="search" value="{{ request('search') }}" placeholder="Cari nama / kode registrasi" class="input-control pl-9 text-sm">
                </label>
                <label>
                    <span class="sr-only">Filter status</span>
                    <select name="status" class="input-control text-sm">
                        <option value="">Semua status</option>
                        <option value="pending" @selected(request('status') === 'pending')>Menunggu</option>
                        <option value="verified" @selected(request('status') === 'verified')>Terverifikasi</option>
                        <option value="passed" @selected(request('status') === 'passed')>Diterima</option>
                        <option value="rejected" @selected(in_array(request('status'), ['rejected', 'failed']))>Ditolak</option>
                    </select>
                </label>
                <label>
                    <span class="sr-only">Filter jenjang</span>
                    <select name="unit" class="input-control text-sm">
                        <option value="">Semua jenjang</option>
                        @foreach(['TK', 'SD', 'SMP'] as $unit)<option value="{{ $unit }}" @selected(request('unit') === $unit)>{{ $unit }}</option>@endforeach
                    </select>
                </label>
                <div class="flex gap-2 md:col-span-2 xl:col-span-5">
                    <label class="flex-1"><span class="sr-only">Tanggal mulai</span><input type="date" name="date_from" value="{{ request('date_from') }}" class="input-control text-sm" title="Tanggal mulai"></label>
                    <label class="flex-1"><span class="sr-only">Tanggal akhir</span><input type="date" name="date_to" value="{{ request('date_to') }}" class="input-control text-sm" title="Tanggal akhir"></label>
                    <button class="rounded-xl bg-primary px-4 text-sm font-semibold text-white hover:bg-primary-dark">Terapkan</button>
                </div>
            </form>
        </div>

        <div class="table-wrap rounded-none border-0">
            <table class="w-full min-w-[900px] text-left text-sm">
                <thead class="bg-slate-50 text-xs uppercase tracking-wide text-slate-500"><tr>
                    <th class="px-5 py-4 font-semibold">Kode registrasi</th><th class="px-5 py-4 font-semibold">Nama</th><th class="px-5 py-4 font-semibold">Jenjang</th><th class="px-5 py-4 font-semibold">Tanggal</th><th class="px-5 py-4 font-semibold">Kelengkapan dokumen</th><th class="px-5 py-4 font-semibold">Status</th><th class="px-5 py-4 text-right font-semibold">Action</th>
                </tr></thead>
                <tbody class="divide-y divide-slate-100">
                @forelse($registrations as $registration)
                    @php $complete = $registration->documents->where('is_verified', true)->count(); $percent = min(100, (int) round(($complete / 4) * 100)); $meta = $statusMeta[$registration->status] ?? $statusMeta['pending']; @endphp
                    <tr class="hover:bg-slate-50/80">
                        <td class="whitespace-nowrap px-5 py-4 font-mono text-xs font-semibold text-primary">{{ $registration->registration_number ?? '-' }}</td>
                        <td class="px-5 py-4"><p class="font-semibold text-slate-800">{{ $registration->user->name }}</p><p class="mt-0.5 text-xs text-slate-400">{{ $registration->user->email }}</p></td>
                        <td class="px-5 py-4 text-slate-600">{{ $registration->unit }}</td>
                        <td class="whitespace-nowrap px-5 py-4 text-slate-600">{{ $registration->created_at->format('d M Y') }}</td>
                        <td class="px-5 py-4"><div class="flex items-center gap-3"><div class="h-1.5 w-20 overflow-hidden rounded-full bg-slate-100"><div class="h-full rounded-full {{ $complete === 4 ? 'bg-emerald-500' : 'bg-amber-400' }}" style="width: {{ $percent }}%"></div></div><span class="whitespace-nowrap text-xs font-semibold text-slate-600">{{ $complete }}/4 lengkap</span></div></td>
                        <td class="px-5 py-4"><span class="inline-flex items-center gap-2 rounded-full px-2.5 py-1 text-xs font-semibold ring-1 {{ $meta['class'] }}"><span class="h-1.5 w-1.5 rounded-full {{ $meta['dot'] }}"></span>{{ $meta['label'] }}</span></td>
                        <td class="px-5 py-4 text-right"><a href="{{ route('panitia.verification.show', $registration->id) }}" class="inline-flex rounded-lg border border-slate-200 px-3 py-1.5 text-xs font-semibold text-primary hover:border-primary hover:bg-primary/5">Lihat Detail</a></td>
                    </tr>
                @empty
                    <tr><td colspan="7"><x-empty-state icon="users" title="Belum ada pendaftar" description="Tidak ada data yang cocok dengan filter saat ini. Coba ubah filter atau kata kunci pencarian." /></td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <div class="flex flex-col gap-3 border-t border-slate-100 px-5 py-4 text-sm text-slate-500 sm:flex-row sm:items-center sm:justify-between"><span>Menampilkan {{ $registrations->count() }} dari {{ $registrations->total() }} pendaftar</span>{{ $registrations->links() }}</div>
    </section>
</div>
@endsection

