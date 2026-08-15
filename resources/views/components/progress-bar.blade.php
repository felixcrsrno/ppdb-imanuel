@props(['value' => 0, 'label' => null, 'tone' => 'primary'])
@php $fill = ['primary' => 'bg-primary', 'success' => 'bg-emerald-500', 'warning' => 'bg-amber-400', 'danger' => 'bg-rose-500'][$tone] ?? 'bg-primary'; @endphp
<div {{ $attributes }} @if($label) aria-label="{{ $label }}" @endif role="progressbar" aria-valuenow="{{ $value }}" aria-valuemin="0" aria-valuemax="100"><div class="h-2 overflow-hidden rounded-full bg-slate-100"><div class="h-full rounded-full {{ $fill }} transition-[width] duration-300" style="width: {{ max(0, min(100, $value)) }}%"></div></div></div>

