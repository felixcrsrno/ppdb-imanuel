@props(['label' => 'Menu'])
<div x-data="{ open: false }" class="relative"><button type="button" @click="open = !open" :aria-expanded="open" class="inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-50">{{ $label }} <span aria-hidden="true">âŒ„</span></button><div x-show="open" x-cloak x-transition @click.outside="open = false" class="absolute right-0 z-20 mt-2 min-w-48 rounded-xl border border-slate-200 bg-white p-2 shadow-xl">{{ $slot }}</div></div>

