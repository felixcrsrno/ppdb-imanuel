@props(['name', 'label' => null, 'required' => false, 'rows' => 4])
<div><label for="{{ $name }}" class="block text-sm font-semibold text-slate-700">{{ $label ?? ucfirst(str_replace('_', ' ', $name)) }} @if($required)<span class="text-rose-500" aria-hidden="true">*</span>@endif</label><textarea id="{{ $name }}" name="{{ $name }}" rows="{{ $rows }}" @required($required) {{ $attributes->merge(['class' => 'input-control mt-2']) }}>{{ $slot }}</textarea>@error($name)<p class="mt-1 text-xs font-medium text-rose-600" role="alert">{{ $message }}</p>@enderror</div>

