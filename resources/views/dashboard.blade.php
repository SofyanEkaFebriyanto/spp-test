<x-app-layout>
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-800">Dashboard Utama</h1>
        <p class="text-gray-500 mt-1">Ringkasan data aplikasi SPP hari ini.</p>
    </div>

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Card 1 -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex items-center">
            <div class="w-14 h-14 rounded-full bg-[#4A6CF7]/10 flex items-center justify-center text-[#4A6CF7] mr-4">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
            </div>
            <div>
                <p class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Total Siswa</p>
                <p class="text-2xl font-extrabold text-gray-800">{{ number_format($totalSiswa) }}</p>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex items-center">
            <div class="w-14 h-14 rounded-full bg-[#4A6CF7]/10 flex items-center justify-center text-[#4A6CF7] mr-4">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
            </div>
            <div>
                <p class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Total Kelas</p>
                <p class="text-2xl font-extrabold text-gray-800">{{ number_format($totalKelas) }}</p>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex items-center">
            <div class="w-14 h-14 rounded-full bg-[#4A6CF7]/10 flex items-center justify-center text-[#4A6CF7] mr-4">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            </div>
            <div>
                <p class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Total Petugas</p>
                <p class="text-2xl font-extrabold text-gray-800">{{ number_format($totalPetugas) }}</p>
            </div>
        </div>

        <!-- Card 4 -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex items-center">
            <div class="w-14 h-14 rounded-full bg-[#4A6CF7]/10 flex items-center justify-center text-[#4A6CF7] mr-4">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
            </div>
            <div>
                <p class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Transaksi</p>
                <p class="text-2xl font-extrabold text-gray-800">{{ number_format($totalTransaksi) }}</p>
            </div>
        </div>
    </div>

    <!-- Main Table Area Placeholder -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100">
        <div class="p-6 border-b border-gray-100 flex items-center justify-between">
            <h2 class="text-lg font-bold text-gray-800">Pembayaran Terbaru</h2>
            <button class="text-[#4A6CF7] font-semibold text-sm hover:underline">Lihat Semua</button>
        </div>
        <div class="p-8 text-center text-gray-500">
            [ Area tabel pembayaran bulan ini akan ditampilkan di sini ]
        </div>
    </div>
</x-app-layout>
