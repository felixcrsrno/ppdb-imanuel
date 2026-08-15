@props(['label' => 'Memproses...', 'class' => ''])
<div {{ $attributes->merge(['class' => 'flex items-center gap-3 text-sm text-slate-500 '.$class]) }} role="status" aria-live="polite"><span class="loading-spinner text-primary" aria-hidden="true"></span><span>{{ $label }}</span></div>

