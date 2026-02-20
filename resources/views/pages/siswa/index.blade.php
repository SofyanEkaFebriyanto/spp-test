<x-layouts.app title="Siswa">
    @include('pages.partials.crud-header', ['title' => 'Data Siswa', 'button' => 'Tambah Siswa'])
    <x-ui.card class="mt-4 p-4">
        <x-ui.table>
            <thead class="bg-slate-50"><tr><th class="th">NISN</th><th class="th">Nama</th><th class="th">Kelas</th><th class="th">Alamat</th><th class="th">Telp</th><th class="th">Aksi</th></tr></thead>
            <tbody>@foreach($data as $row)<tr class="border-t"><td class="td">{{ $row['nisn'] }}</td><td class="td">{{ $row['nama'] }}</td><td class="td">{{ $row['kelas'] }}</td><td class="td">{{ $row['alamat'] }}</td><td class="td">{{ $row['telp'] }}</td><td class="td space-x-1"><x-ui.button variant="warning">Edit</x-ui.button><x-ui.button variant="danger">Hapus</x-ui.button></td></tr>@endforeach</tbody>
        </x-ui.table>
        @include('pages.partials.pagination')
    </x-ui.card>
    @include('pages.partials.crud-modal', ['id' => 'siswaModal', 'title' => 'Form Siswa'])
</x-layouts.app>
