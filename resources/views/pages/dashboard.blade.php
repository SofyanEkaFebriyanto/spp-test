<x-layouts.app title="Dashboard">
    <h1 class="text-2xl font-bold mb-4">Dashboard</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4">
        <x-ui.card class="p-4"><p class="text-sm text-slate-500">Total Siswa</p><p class="text-2xl font-bold mt-1">{{ $stats['total_siswa'] }}</p></x-ui.card>
        <x-ui.card class="p-4"><p class="text-sm text-slate-500">Transaksi Bulan Ini</p><p class="text-2xl font-bold mt-1">{{ $stats['transaksi_bulan_ini'] }}</p></x-ui.card>
        <x-ui.card class="p-4"><p class="text-sm text-slate-500">Pemasukan Bulan Ini</p><p class="text-2xl font-bold mt-1">Rp {{ number_format($stats['pemasukan_bulan_ini'],0,',','.') }}</p></x-ui.card>
        <x-ui.card class="p-4"><p class="text-sm text-slate-500">Siswa Belum Bayar</p><p class="text-2xl font-bold mt-1">{{ $stats['belum_bayar'] }}</p></x-ui.card>
    </div>
    <x-ui.card class="mt-6 p-6">
        <h2 class="font-semibold mb-4">Tren Pembayaran</h2>
        <div class="h-64 flex items-end gap-2">
            @foreach($bars as $bar)
                <div class="flex-1 bg-blue-200 rounded-t" style="height: {{ $bar }}%"></div>
            @endforeach
        </div>
    </x-ui.card>
</x-layouts.app>
