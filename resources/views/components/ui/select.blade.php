@props(['label' => null, 'name', 'options' => []])
<div>
    @if($label)<label for="{{ $name }}" class="block text-sm font-medium text-slate-700 mb-1">{{ $label }}</label>@endif
    <select id="{{ $name }}" name="{{ $name }}" {{ $attributes->merge(['class' => 'w-full rounded-md border-slate-300 focus:border-blue-800 focus:ring-blue-800 text-sm']) }}>
        @foreach($options as $value => $text)
            <option value="{{ $value }}">{{ $text }}</option>
        @endforeach
    </select>
</div>
