@props(['label' => null, 'name', 'type' => 'text'])
<div>
    @if($label)<label for="{{ $name }}" class="block text-sm font-medium text-slate-700 mb-1">{{ $label }}</label>@endif
    <input id="{{ $name }}" name="{{ $name }}" type="{{ $type }}" {{ $attributes->merge(['class' => 'w-full rounded-md border-slate-300 focus:border-blue-800 focus:ring-blue-800 text-sm']) }}>
</div>
