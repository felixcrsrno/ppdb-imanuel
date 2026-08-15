@props(['open' => 'modalOpen', 'title' => 'Konfirmasi tindakan', 'description' => 'Periksa kembali tindakan ini sebelum melanjutkan.', 'consequence' => null, 'confirmText' => 'Konfirmasi', 'cancelText' => 'Batal', 'confirmAction' => null])
<div x-show="{{ $open }}" x-cloak x-transition.opacity class="fixed inset-0 z-[80] flex items-center justify-center bg-slate-950/50 p-4" role="dialog" aria-modal="true" aria-labelledby="modal-title" @keydown.escape.window="{{ $open }} = false">
    <div x-show="{{ $open }}" x-transition @click.outside="{{ $open }} = false" class="w-full max-w-md rounded-3xl bg-white p-6 shadow-2xl">
        <div class="flex items-start justify-between gap-4"><div><p class="eyebrow">Konfirmasi</p><h2 id="modal-title" class="mt-1 text-xl font-bold text-text-navy">{{ $title }}</h2></div><button type="button" @click="{{ $open }} = false" class="rounded-lg p-1 text-2xl leading-none text-slate-400 hover:bg-slate-100 hover:text-slate-700" aria-label="Tutup modal">Ã—</button></div>
        <p class="mt-4 text-sm leading-6 text-slate-600">{{ $description }}</p>
        @if($consequence)<div class="mt-4 rounded-xl border border-amber-200 bg-amber-50 p-3 text-sm leading-6 text-amber-900"><strong>Perhatian:</strong> {{ $consequence }}</div>@endif
        @if(trim((string) $slot) !== '')<div class="mt-4">{{ $slot }}</div>@endif
        <div class="mt-6 flex flex-col-reverse gap-3 sm:flex-row sm:justify-end"><button type="button" @click="{{ $open }} = false" class="rounded-xl border border-slate-200 px-4 py-2.5 text-sm font-semibold text-slate-600 hover:bg-slate-50">{{ $cancelText }}</button><button type="button" data-confirm @click="{{ $confirmAction ?: $open.' = false' }}" class="rounded-xl bg-primary px-4 py-2.5 text-sm font-semibold text-white hover:bg-primary-dark">{{ $confirmText }}</button></div>
    </div>
</div>

