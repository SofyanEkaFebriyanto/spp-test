@props(['variant' => 'default'])
@php
    $styles = [
        'default' => 'bg-slate-100 text-slate-700',
        'admin' => 'bg-blue-100 text-blue-700',
        'petugas' => 'bg-emerald-100 text-emerald-700',
    ];
@endphp
<span {{ $attributes->merge(['class' => 'inline-flex px-2 py-1 rounded-full text-xs font-semibold '.$styles[$variant]]) }}>{{ $slot }}</span>
