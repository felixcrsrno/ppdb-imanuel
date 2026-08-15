@props(['class' => 'h-4 w-full'])
<span {{ $attributes->merge(['class' => 'skeleton block rounded-lg '.$class]) }} aria-hidden="true"></span>

