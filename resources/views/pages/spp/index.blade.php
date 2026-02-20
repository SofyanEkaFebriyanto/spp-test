<x-layouts.app title="SPP">
    @include('pages.partials.crud-header', ['title' => 'Data SPP', 'button' => 'Tambah SPP'])
    <x-ui.card class="mt-4 p-4"><x-ui.table><thead class="bg-slate-50"><tr><th class="th">Tahun</th><th class="th">Nominal</th><th class="th">Keterangan</th><th class="th">Aksi</th></tr></thead><tbody>@foreach($data as $row)<tr class="border-t"><td class="td">{{ $row['tahun'] }}</td><td class="td">Rp {{ number_format($row['nominal'],0,',','.') }}</td><td class="td">{{ $row['keterangan'] }}</td><td class="td space-x-1"><x-ui.button variant="warning">Edit</x-ui.button><x-ui.button variant="danger">Hapus</x-ui.button></td></tr>@endforeach</tbody></x-ui.table>@include('pages.partials.pagination')</x-ui.card>
    @include('pages.partials.crud-modal', ['id' => 'sppModal', 'title' => 'Form SPP', 'note' => 'Tidak dapat hapus jika masih dipakai'])
</x-layouts.app>
