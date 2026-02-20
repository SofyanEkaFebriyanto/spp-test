@props(['id', 'title' => 'Modal'])
<div id="{{ $id }}" class="hidden fixed inset-0 z-50 bg-black/40 p-4 items-center justify-center">
    <div class="bg-white rounded-lg w-full max-w-lg shadow-lg">
        <div class="px-5 py-4 border-b flex items-center justify-between">
            <h3 class="font-semibold text-slate-800">{{ $title }}</h3>
            <button type="button" class="text-slate-500" onclick="document.getElementById('{{ $id }}').classList.add('hidden')">✕</button>
        </div>
        <div class="p-5">{{ $slot }}</div>
    </div>
</div>
