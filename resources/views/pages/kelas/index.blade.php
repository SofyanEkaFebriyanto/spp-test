<x-layouts.app title="Kelas">
    @include('pages.partials.crud-header', ['title' => 'Data Kelas', 'button' => 'Tambah Kelas'])
    <x-ui.card class="mt-4 p-4"><x-ui.table><thead class="bg-slate-50"><tr><th class="th">Kode</th><th class="th">Nama</th><th class="th">Kompetensi</th><th class="th">Wali Kelas</th><th class="th">Aksi</th></tr></thead><tbody>@foreach($data as $row)<tr class="border-t"><td class="td">{{ $row['kode'] }}</td><td class="td">{{ $row['nama'] }}</td><td class="td">{{ $row['kompetensi'] }}</td><td class="td">{{ $row['wali'] }}</td><td class="td space-x-1"><x-ui.button variant="warning">Edit</x-ui.button><x-ui.button variant="danger">Hapus</x-ui.button></td></tr>@endforeach</tbody></x-ui.table>@include('pages.partials.pagination')</x-ui.card>
    @include('pages.partials.crud-modal', ['id' => 'kelasModal', 'title' => 'Form Kelas', 'note' => 'Tidak dapat hapus jika masih dipakai'])
</x-layouts.app>
