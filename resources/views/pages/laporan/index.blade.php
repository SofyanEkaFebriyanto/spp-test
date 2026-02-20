<x-layouts.app title="Laporan Pembayaran">
    <h1 class="text-2xl font-bold mb-4">Laporan Pembayaran</h1>
    <x-ui.card class="p-4 mb-4">
        <div class="grid md:grid-cols-4 gap-3">
            <x-ui.input name="start" label="Tanggal Mulai" type="date"/>
            <x-ui.input name="end" label="Tanggal Akhir" type="date"/>
            <x-ui.select name="kelas" label="Kelas" :options="array_combine($classes,$classes)"/>
            <div class="flex items-end"><x-ui.button>Generate</x-ui.button></div>
        </div>
    </x-ui.card>
    <x-ui.card class="p-4 mb-4"><div class="flex flex-wrap gap-6"><p>Total transaksi: <b>{{ $summary['total_transaksi'] }}</b></p><p>Total pemasukan: <b>Rp {{ number_format($summary['total_pemasukan'],0,',','.') }}</b></p></div></x-ui.card>
    <x-ui.card class="p-4"><div class="flex justify-end mb-3"><x-ui.button variant="secondary">Cetak PDF</x-ui.button></div><x-ui.table><thead class="bg-slate-50"><tr><th class="th">Tanggal</th><th class="th">NISN</th><th class="th">Nama</th><th class="th">Kelas</th><th class="th">Bulan</th><th class="th">Tahun</th><th class="th">Nominal</th><th class="th">Petugas</th></tr></thead><tbody>@foreach($data as $row)<tr class="border-t"><td class="td">{{ $row['tanggal'] }}</td><td class="td">{{ $row['nisn'] }}</td><td class="td">{{ $row['nama'] }}</td><td class="td">{{ $row['kelas'] }}</td><td class="td">{{ $row['bulan'] }}</td><td class="td">{{ $row['tahun'] }}</td><td class="td">Rp {{ number_format($row['nominal'],0,',','.') }}</td><td class="td">{{ $row['petugas'] }}</td></tr>@endforeach</tbody></x-ui.table></x-ui.card>
</x-layouts.app>
