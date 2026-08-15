@props(['type' => 'info', 'title' => null])
@php $styles = ['info' => 'border-blue-200 bg-blue-50 text-blue-900', 'success' => 'border-emerald-200 bg-emerald-50 text-emerald-900', 'warning' => 'border-amber-200 bg-amber-50 text-amber-900', 'danger' => 'border-rose-200 bg-rose-50 text-rose-900']; $style = $styles[$type] ?? $styles['info']; @endphp
<div {{ $attributes->merge(['class' => 'flex gap-3 rounded-2xl border p-4 text-sm '.$style]) }} role="alert">
    <span class="mt-0.5 font-bold" aria-hidden="true">{{ $type === 'success' ? 'âœ“' : ($type === 'danger' ? '!' : 'i') }}</span>
    <div class="min-w-0 flex-1">@if($title)<p class="font-bold">{{ $title }}</p>@endif<p class="leading-6">{{ $slot }}</p></div>
</div>

