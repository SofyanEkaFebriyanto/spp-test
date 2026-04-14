<x-app-layout>
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800 tracking-tight">Selamat Datang, {{ $siswa->nama ?? Auth::user()->name }}</h1>
        <p class="text-gray-500 mt-1 font-medium">Berikut adalah histori pembayaran SPP Anda.</p>
    </div>

    <!-- Student Info Card -->
    <div class="bg-gradient-to-r from-[#4A6CF7] to-[#3451b2] rounded-2xl p-8 shadow-md text-white mb-8 relative overflow-hidden">
        <svg class="absolute top-0 right-0 opacity-10 w-64 h-64 -mt-16 -mr-16" fill="currentColor" viewBox="0 0 24 24"><path d="M12 14l9-5-9-5-9 5 9 5z"/><path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"/></svg>
        <div class="relative z-10 flex flex-col md:flex-row justify-between items-start md:items-center">
            <div>
                <p class="text-blue-100 mb-1 text-sm uppercase tracking-wider font-semibold">Identitas Siswa</p>
                <h2 class="text-3xl font-bold mb-2">{{ $siswa->nama ?? Auth::user()->name }}</h2>
                <div class="flex items-center space-x-4 text-sm font-medium">
                    <span class="bg-white/20 px-3 py-1 rounded-full">NISN: {{ $siswa->nisn ?? '-' }}</span>
                    <span class="bg-white/20 px-3 py-1 rounded-full">Kelas: {{ $siswa->kelas->nama_kelas ?? '-' }}</span>
                </div>
            </div>
            <div class="mt-6 md:mt-0 text-right">
                <p class="text-blue-100 mb-1 text-sm uppercase tracking-wider font-semibold">Total Terbayar</p>
                <p class="text-4xl font-extrabold">Rp {{ number_format($pembayarans->sum('jumlah_bayar'), 0, ',', '.') }}</p>
            </div>
        </div>
    </div>

    <!-- History Table Area -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-100">
            <h2 class="text-lg font-bold text-gray-800">Catatan Histori Pembayaran</h2>
        </div>
        
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-100 text-gray-600 text-sm uppercase tracking-wider">
                    <th class="p-4 font-semibold">Tanggal</th>
                    <th class="p-4 font-semibold">Untuk Bulan/Tahun</th>
                    <th class="p-4 font-semibold">Nominal</th>
                    <th class="p-4 font-semibold">Petugas Penerima</th>
                </tr>
            </thead>
            <tbody class="text-gray-700 divide-y divide-gray-100">
                @forelse($pembayarans as $bayar)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="p-4 font-medium">{{ \Carbon\Carbon::parse($bayar->tgl_bayar)->format('d M Y') }}</td>
                    <td class="p-4">{{ $bayar->bulan_dibayar }} {{ $bayar->tahun_dibayar }}</td>
                    <td class="p-4 font-bold text-green-600">Rp {{ number_format($bayar->jumlah_bayar, 0, ',', '.') }}</td>
                    <td class="p-4 text-gray-500">{{ $bayar->petugas->name ?? 'Admin' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="p-8 text-center text-gray-500">
                        Belum ada histori pembayaran.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>
