@props(['variant' => 'primary', 'type' => 'button', 'as' => 'button'])
@php
    $base = 'inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl text-sm font-semibold focus-ring';
    if($variant === 'primary') {
        $classes = $base.' bg-primary text-white shadow-sm hover:-translate-y-px hover:bg-primary-dark';
    } elseif($variant === 'ghost') {
        $classes = $base.' bg-white border border-slate-200 text-slate-700 hover:bg-slate-50';
    } else {
        $classes = $base.' bg-slate-100 text-slate-700 hover:bg-slate-200';
    }
@endphp
@if($as === 'a')
    <a {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</button>
@endif

