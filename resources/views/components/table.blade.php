@props(['class' => ''])
<div {{ $attributes->merge(['class' => 'overflow-x-auto rounded-card border border-slate-100']) }}>
    <table role="table" class="min-w-full divide-y divide-slate-200 text-sm {{ $class }}" aria-label="{{ $attributes->get('aria-label') ?? 'Tabel' }}">
        {{ $slot }}
    </table>
</div>

