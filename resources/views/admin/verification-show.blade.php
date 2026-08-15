@extends('layouts.app')

@section('content')
@php
    $profile = $registration->studentProfile;
    $statusLabels = ['draft' => 'Menunggu', 'pending' => 'Menunggu', 'verified' => 'Terverifikasi', 'passed' => 'Diterima', 'rejected' => 'Ditolak', 'failed' => 'Ditolak'];
    $statusStyles = ['draft' => 'bg-slate-100 text-slate-600 ring-slate-200', 'pending' => 'bg-amber-50 text-amber-700 ring-amber-200', 'verified' => 'bg-emerald-50 text-emerald-700 ring-emerald-200', 'passed' => 'bg-blue-50 text-blue-700 ring-blue-200', 'rejected' => 'bg-rose-50 text-rose-700 ring-rose-200', 'failed' => 'bg-rose-50 text-rose-700 ring-rose-200'];
    $documentLabels = ['akta' => 'Akta Kelahiran', 'kk' => 'Kartu Keluarga', 'ijazah_rapor' => 'Ijazah / Rapor', 'pasfoto' => 'Pasfoto'];
    $maskedNik = filled($profile->nik ?? null) ? str_repeat('*', max(0, strlen((string) $profile->nik) - 4)) . substr((string) $profile->nik, -4) : '-';
@endphp

<div x-data="{ status: @js($registration->status), confirmOpen: false }" class="page-shell mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
        <div><a href="{{ route('panitia.verification.index') }}" class="text-sm font-semibold text-primary hover:underline">â† Kembali ke daftar verifikasi</a><p class="eyebrow mt-6">Ruang kerja panitia</p><h1 class="mt-2 text-3xl font-bold tracking-tight text-text-navy">Detail Verifikasi</h1><p class="mt-2 text-sm text-slate-500">Periksa data dan berkas sebelum menetapkan keputusan pendaftaran.</p></div>
        <div class="rounded-2xl border border-slate-200 bg-white px-5 py-4 shadow-sm sm:min-w-64"><p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Status saat ini</p><span class="mt-2 inline-flex rounded-full px-3 py-1 text-sm font-semibold ring-1 {{ $statusStyles[$registration->status] ?? $statusStyles['pending'] }}">{{ $statusLabels[$registration->status] ?? ucfirst($registration->status) }}</span></div>
    </div>

    <section class="card mb-6 grid gap-5 p-5 sm:grid-cols-2 lg:grid-cols-4 lg:p-6">
        <div><p class="text-xs uppercase tracking-wide text-slate-400">Nama pendaftar</p><p class="mt-1 font-bold text-slate-800">{{ $profile->full_name ?? $registration->user->name }}</p></div>
        <div><p class="text-xs uppercase tracking-wide text-slate-400">Nomor registrasi</p><p class="mt-1 font-mono text-sm font-bold text-primary">{{ $registration->registration_number }}</p></div>
        <div><p class="text-xs uppercase tracking-wide text-slate-400">Jenjang</p><p class="mt-1 font-bold text-slate-800">{{ $registration->unit }}</p></div>
        <div><p class="text-xs uppercase tracking-wide text-slate-400">Tanggal pendaftaran</p><p class="mt-1 font-bold text-slate-800">{{ $registration->created_at->format('d M Y, H:i') }}</p></div>
    </section>

    <div class="grid items-start gap-6 lg:grid-cols-[1fr_1.05fr]">
        <section class="card p-5 sm:p-6">
            <div class="flex items-center justify-between"><div><p class="eyebrow">Data calon peserta</p><h2 class="mt-1 text-xl font-bold text-text-navy">Informasi Pendaftar</h2></div><span class="rounded-xl bg-primary/5 px-3 py-2 text-xs font-semibold text-primary">{{ $registration->unit }}</span></div>
            <div class="mt-6 space-y-6">
                <div><h3 class="mb-3 text-sm font-bold text-slate-800">Data Personal</h3><dl class="grid gap-x-5 gap-y-4 sm:grid-cols-2">@foreach([['Nama', $profile->full_name ?? $registration->user->name], ['NIK', $maskedNik], ['Jenis Kelamin', $profile->gender ?? '-'], ['Tempat Lahir', $profile->birth_place ?? '-'], ['Tanggal Lahir', $profile->birth_date ? \Illuminate\Support\Carbon::parse($profile->birth_date)->format('d M Y') : '-'], ['Email', $registration->user->email ?? '-']] as $item)<div><dt class="text-xs text-slate-400">{{ $item[0] }}</dt><dd class="mt-1 text-sm font-semibold text-slate-700">{{ $item[1] }}</dd></div>@endforeach</dl><p class="mt-3 text-xs text-slate-400">NIK ditampilkan sebagian untuk menjaga privasi.</p></div>
                <div class="border-t border-slate-100 pt-6"><h3 class="mb-3 text-sm font-bold text-slate-800">Data Orang Tua</h3><dl class="grid gap-x-5 gap-y-4 sm:grid-cols-2">@foreach([['Nama Orang Tua', $profile->parent_name ?? '-'], ['Nomor Telepon', $profile->parent_phone ?? '-'], ['Pekerjaan', $profile->parent_job ?? '-']] as $item)<div><dt class="text-xs text-slate-400">{{ $item[0] }}</dt><dd class="mt-1 text-sm font-semibold text-slate-700">{{ $item[1] }}</dd></div>@endforeach</dl></div>
                <div class="border-t border-slate-100 pt-6"><h3 class="mb-3 text-sm font-bold text-slate-800">Alamat</h3><p class="rounded-xl bg-slate-50 p-4 text-sm leading-6 text-slate-600">{{ $profile->address ?? 'Alamat belum diisi.' }}</p></div>
            </div>
        </section>

        <section class="card p-5 sm:p-6">
            <div class="flex items-end justify-between"><div><p class="eyebrow">Pemeriksaan berkas</p><h2 class="mt-1 text-xl font-bold text-text-navy">Berkas Pendaftaran</h2></div><span class="text-sm text-slate-400">{{ $registration->documents->where('is_verified', true)->count() }}/4 valid</span></div>
            <div class="mt-6 space-y-3">
                @foreach($documentLabels as $type => $label)
                    @php $document = $registration->documents->firstWhere('file_type', $type); $valid = $document?->is_verified; $hasIssue = $document && $document->notes; @endphp
                    <article class="rounded-2xl border {{ $valid ? 'border-emerald-200 bg-emerald-50/40' : ($hasIssue ? 'border-orange-200 bg-orange-50/40' : 'border-slate-200 bg-white') }} p-4">
                        <div class="flex items-start gap-3"><span class="mt-0.5 flex h-9 w-9 shrink-0 items-center justify-center rounded-xl {{ $valid ? 'bg-emerald-100 text-emerald-700' : ($hasIssue ? 'bg-orange-100 text-orange-700' : 'bg-slate-100 text-slate-500') }}">{{ $valid ? 'âœ“' : '!' }}</span><div class="min-w-0 flex-1"><div class="flex flex-wrap items-center justify-between gap-2"><h3 class="font-bold text-slate-800">{{ $label }}</h3><span class="text-xs font-semibold {{ $valid ? 'text-emerald-700' : ($hasIssue ? 'text-orange-700' : 'text-slate-500') }}">{{ $valid ? 'Valid' : ($hasIssue ? 'Perlu Perbaikan' : 'Belum diperiksa') }}</span></div><p class="mt-1 text-xs text-slate-500">{{ $document?->notes ?: ($document ? 'Dokumen tersedia dan menunggu pemeriksaan panitia.' : 'Dokumen belum diunggah.') }}</p><div class="mt-3 flex items-center gap-3">@if($document)<a href="{{ asset('storage/' . $document->file_path) }}" target="_blank" rel="noopener" class="text-xs font-bold text-primary hover:underline">Lihat Dokumen â†—</a><a href="{{ asset('storage/' . $document->file_path) }}" target="_blank" rel="noopener" class="rounded-lg border border-slate-200 px-2.5 py-1 text-xs font-semibold text-slate-600 hover:bg-white">Periksa file</a>@else<span class="text-xs text-slate-400">Tidak ada file untuk diperiksa</span>@endif</div></div></div>
                    </article>
                @endforeach
            </div>
        </section>
    </div>

    <section class="card mt-6 p-5 sm:p-6">
        <div><p class="eyebrow">Keputusan panitia</p><h2 class="mt-1 text-xl font-bold text-text-navy">Status Pendaftaran</h2><p class="mt-1 text-sm text-slate-500">Pilih keputusan yang sesuai dengan hasil pemeriksaan dokumen.</p></div>
        <div class="mt-5 grid gap-3 sm:grid-cols-2 lg:grid-cols-5">
            @foreach([['value' => 'pending', 'label' => 'Menunggu', 'style' => 'amber'], ['value' => 'verified', 'label' => 'Diverifikasi', 'style' => 'emerald'], ['value' => 'revision', 'label' => 'Perlu Perbaikan', 'style' => 'orange'], ['value' => 'passed', 'label' => 'Diterima', 'style' => 'blue'], ['value' => 'rejected', 'label' => 'Ditolak', 'style' => 'rose']] as $option)
                <button type="button" @click="status = '{{ $option['value'] }}'" class="rounded-xl border px-3 py-3 text-left text-sm font-semibold transition" :class="status === '{{ $option['value'] }}' ? 'border-primary bg-primary/5 text-primary ring-2 ring-primary/10' : 'border-slate-200 text-slate-600 hover:border-slate-300'">{{ $option['label'] }}<span class="mt-1 block text-xs font-normal text-slate-400">{{ $option['value'] === 'revision' ? 'Catatan diperlukan' : 'Siap dipilih' }}</span></button>
            @endforeach
        </div>
        <form action="{{ route('panitia.verification.update-status', $registration->id) }}" method="POST" class="mt-5" @submit.prevent="if (status !== 'revision') confirmOpen = true">
            @csrf @method('PATCH')
            <input type="hidden" name="status" :value="status">
            <div x-show="status === 'revision'" x-cloak class="rounded-xl border border-orange-200 bg-orange-50 p-4"><label for="verification-note" class="block text-sm font-bold text-orange-900">Catatan Verifikasi</label><textarea id="verification-note" rows="3" class="input-control mt-2 border-orange-200" placeholder="Jelaskan dokumen atau data yang perlu diperbaiki..."></textarea><p class="mt-2 text-xs text-orange-700">Status Perlu Perbaikan belum tersedia pada backend saat ini, sehingga belum dapat disimpan.</p></div>
            <div x-show="status === 'rejected'" x-cloak class="rounded-xl border border-rose-200 bg-rose-50 p-4"><label for="rejection-reason" class="block text-sm font-bold text-rose-900">Alasan Penolakan</label><textarea id="rejection-reason" rows="3" class="input-control mt-2 border-rose-200" placeholder="Tuliskan alasan penolakan..."></textarea></div>
            <div class="mt-5 flex flex-col items-start gap-3 sm:flex-row sm:items-center sm:justify-between"><p class="text-xs text-slate-400">Perubahan status akan memicu notifikasi pendaftar.</p><button type="submit" :disabled="status === 'revision'" class="rounded-xl bg-primary px-4 py-2.5 text-sm font-semibold text-white hover:bg-primary-dark disabled:cursor-not-allowed disabled:bg-slate-300">Simpan keputusan</button></div>
        </form>
    </section>

    <div x-show="confirmOpen" x-cloak class="fixed inset-0 z-[60] flex items-center justify-center bg-slate-900/40 p-4" role="dialog" aria-modal="true" @keydown.escape.window="confirmOpen = false">
        <div @click.outside="confirmOpen = false" class="w-full max-w-md rounded-2xl bg-white p-6 shadow-2xl"><div class="flex items-start justify-between"><div><p class="eyebrow">Konfirmasi perubahan</p><h2 class="mt-1 text-xl font-bold text-text-navy">Simpan status baru?</h2></div><button type="button" @click="confirmOpen = false" class="text-2xl leading-none text-slate-400 hover:text-slate-700" aria-label="Tutup">Ã—</button></div><p class="mt-4 text-sm leading-6 text-slate-600">Apakah Anda yakin ingin mengubah status menjadi <strong x-text="{pending:'Menunggu',verified:'Diverifikasi',passed:'Diterima',rejected:'Ditolak'}[status]"></strong>?</p><div class="mt-4 rounded-xl bg-slate-50 p-4 text-sm"><p class="font-semibold text-slate-800">{{ $profile->full_name ?? $registration->user->name }}</p><p class="mt-1 font-mono text-xs text-slate-500">{{ $registration->registration_number }}</p></div><div class="mt-6 flex justify-end gap-3"><button type="button" @click="confirmOpen = false" class="rounded-xl border border-slate-200 px-4 py-2.5 text-sm font-semibold text-slate-600 hover:bg-slate-50">Batal</button><button type="button" @click="$el.closest('.fixed').previousElementSibling.querySelector('form').submit()" class="rounded-xl bg-primary px-4 py-2.5 text-sm font-semibold text-white hover:bg-primary-dark">Konfirmasi</button></div></div>
    </div>
</div>
@endsection

