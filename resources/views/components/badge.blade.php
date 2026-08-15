@props(['type' => 'neutral'])
@php
    $map = [
        'info' => 'inline-flex items-center gap-2 rounded-lg bg-blue-50 text-blue-800 px-2.5 py-1 text-xs font-semibold',
        'success' => 'inline-flex items-center gap-2 rounded-lg bg-emerald-50 text-emerald-700 px-2.5 py-1 text-xs font-semibold',
        'warning' => 'inline-flex items-center gap-2 rounded-lg bg-amber-50 text-amber-700 px-2.5 py-1 text-xs font-semibold',
        'danger' => 'inline-flex items-center gap-2 rounded-lg bg-rose-50 text-rose-700 px-2.5 py-1 text-xs font-semibold',
        'neutral' => 'inline-flex items-center gap-2 rounded-lg bg-slate-100 text-slate-700 px-2.5 py-1 text-xs font-semibold',
    ];
    $classes = $map[$type] ?? $map['neutral'];
@endphp
<span {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</span>

