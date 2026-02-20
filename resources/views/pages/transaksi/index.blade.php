<x-layouts.app title="Transaksi">
    <h1 class="text-2xl font-bold mb-4">Entri Transaksi Pembayaran</h1>
    @if(session('success')) <div class="mb-4 p-3 bg-emerald-100 text-emerald-800 rounded">{{ session('success') }}</div> @endif
    <div class="grid lg:grid-cols-3 gap-4">
        <x-ui.card class="p-4 lg:col-span-1"><h2 class="font-semibold mb-3">Cari Siswa</h2><form method="GET" action="{{ route('transaksi.index') }}" class="space-y-3"><x-ui.input name="nisn" label="NISN" placeholder="Masukkan NISN" :value="request('nisn')"/><x-ui.button type="submit">Cari</x-ui.button></form></x-ui.card>
        <x-ui.card class="p-4 lg:col-span-1"><h2 class="font-semibold mb-3">Info Siswa</h2>@if($student)<div class="space-y-2 text-sm"><p><b>Nama:</b> {{ $student['nama'] }}</p><p><b>Kelas:</b> {{ $student['kelas'] }}</p><p><b>Nominal SPP:</b> Rp {{ number_format($student['nominal'],0,',','.') }}</p></div>@else<p class="text-slate-500 text-sm">Cari siswa terlebih dahulu.</p>@endif</x-ui.card>
        <x-ui.card class="p-4 lg:col-span-1"><h2 class="font-semibold mb-3">Form Pembayaran</h2><form method="POST" action="{{ route('transaksi.store') }}" class="space-y-3">@csrf
            <input type="hidden" name="nisn" value="{{ $student['nisn'] ?? '' }}"><input type="hidden" name="nama" value="{{ $student['nama'] ?? '' }}"><input type="hidden" name="kelas" value="{{ $student['kelas'] ?? '' }}">
            <x-ui.select name="bulan" label="Bulan Dibayar" :options="['Januari'=>'Januari','Februari'=>'Februari','Maret'=>'Maret','April'=>'April','Mei'=>'Mei','Juni'=>'Juni','Juli'=>'Juli','Agustus'=>'Agustus','September'=>'September','Oktober'=>'Oktober','November'=>'November','Desember'=>'Desember']"/>
            <x-ui.select name="tahun" label="Tahun Dibayar" :options="array_combine($years,$years)"/>
            <x-ui.input name="nominal" label="Nominal Bayar" type="number" :value="$student['nominal'] ?? ''"/>
            <x-ui.button variant="success" type="submit" class="w-full py-3 text-base">Bayar</x-ui.button>
        </form></x-ui.card>
    </div>

    @if($receipt)
        <x-ui.modal id="receiptModal" title="Preview Bukti Pembayaran">
            <div class="space-y-1 text-sm">
                <p><b>Nama:</b> {{ $receipt['nama'] }}</p><p><b>NISN:</b> {{ $receipt['nisn'] }}</p><p><b>Kelas:</b> {{ $receipt['kelas'] }}</p>
                <p><b>Bulan/Tahun:</b> {{ $receipt['bulan'] }} / {{ $receipt['tahun'] }}</p><p><b>Nominal:</b> Rp {{ number_format($receipt['nominal'],0,',','.') }}</p>
                <p><b>Petugas:</b> {{ $receipt['petugas'] }}</p><p><b>Tanggal:</b> {{ $receipt['tanggal'] }}</p>
            </div>
            <div class="mt-4 flex gap-2"><x-ui.button>Cetak</x-ui.button><x-ui.button variant="secondary" onclick="document.getElementById('receiptModal').classList.add('hidden')">Tutup</x-ui.button></div>
        </x-ui.modal>
        <script>document.getElementById('receiptModal').classList.remove('hidden');document.getElementById('receiptModal').classList.add('flex');</script>
    @endif
</x-layouts.app>
