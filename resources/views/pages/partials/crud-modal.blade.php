@props(['id','title','note'=>null])
<x-ui.modal :id="$id" :title="$title">
    <div class="space-y-3">
        <x-ui.input name="field1" label="Nama" />
        <x-ui.input name="field2" label="Keterangan" />
        @if($note)<p class="text-xs text-amber-700 bg-amber-50 p-2 rounded">{{ $note }}</p>@endif
        <div class="flex gap-2"><x-ui.button>Simpan</x-ui.button><x-ui.button variant="secondary" onclick="document.getElementById('{{ $id }}').classList.add('hidden')">Batal</x-ui.button></div>
    </div>
</x-ui.modal>
