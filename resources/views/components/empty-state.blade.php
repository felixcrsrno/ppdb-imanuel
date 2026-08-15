@props(['icon' => 'inbox', 'title' => 'Belum ada data', 'description' => 'Tidak ada item yang cocok dengan filter saat ini.'])
<div {{ $attributes->merge(['class' => 'empty-state px-6 py-12 text-center text-slate-500']) }} role="status">
    <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-primary/10 text-primary" aria-hidden="true">
        @if($icon === 'file') ðŸ“„ @elseif($icon === 'bell') ðŸ”” @elseif($icon === 'users') ðŸ‘¥ @elseif($icon === 'inbox') ðŸ“¥ @else {{ $icon }} @endif
    </div>
    <div class="mt-4 text-lg font-semibold text-text-navy">{{ $title }}</div>
    <p class="mx-auto mt-1 max-w-md text-sm leading-6">{{ $description }}</p>
    @if(trim((string) $slot) !== '')<div class="mt-5">{{ $slot }}</div>@endif
</div>

