<div class="flex flex-col md:flex-row md:items-end md:justify-between gap-3">
    <div>
        <h1 class="text-2xl font-bold">{{ $title }}</h1>
        <div class="mt-3"><x-ui.button onclick="document.querySelector('.fixed.inset-0')?.classList.remove('hidden');document.querySelector('.fixed.inset-0')?.classList.add('flex')">{{ $button }}</x-ui.button></div>
    </div>
    <div class="w-full md:w-72"><x-ui.input name="search" placeholder="Cari data..." /></div>
</div>
