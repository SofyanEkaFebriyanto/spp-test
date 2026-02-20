@props(['variant' => 'primary', 'type' => 'button'])
@php
    $styles = [
        'primary' => 'bg-blue-800 hover:bg-blue-900 text-white',
        'secondary' => 'bg-slate-600 hover:bg-slate-700 text-white',
        'success' => 'bg-emerald-600 hover:bg-emerald-700 text-white',
        'warning' => 'bg-amber-500 hover:bg-amber-600 text-white',
        'danger' => 'bg-red-600 hover:bg-red-700 text-white',
    ];
@endphp
<button type="{{ $type }}" {{ $attributes->merge(['class' => 'px-4 py-2 text-sm font-medium rounded-md transition '.$styles[$variant]]) }}>
    {{ $slot }}
</button>
