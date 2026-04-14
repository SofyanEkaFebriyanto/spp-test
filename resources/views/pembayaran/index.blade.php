<x-app-layout>
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-800 tracking-tight">Transaksi Pembayaran</h1>
            <p class="text-gray-500 mt-1 font-medium">Catat dan Pantau Histori Pembayaran SPP</p>
        </div>
        
        <div class="flex space-x-3">
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <input type="text" id="search-pembayaran" oninput="searchTable(this.value, 'table-pembayaran')" class="bg-white border border-gray-200 text-gray-900 text-sm rounded-lg focus:ring-2 focus:ring-[#4A6CF7] focus:border-transparent block w-64 pl-10 p-2.5 shadow-sm" placeholder="Cari Transaksi....">
            </div>
            
            @if(Auth::user()->role === 'admin')
            <a href="{{ route('pembayaran.laporan') }}" target="_blank" class="bg-[#10B981] hover:bg-[#059669] text-white px-5 py-2.5 rounded-lg shadow-sm flex items-center font-semibold transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                Cetak Laporan
            </a>
            @endif
            <button onclick="document.getElementById('modal-add').classList.remove('hidden')" class="bg-[#4A6CF7] hover:bg-[#3451b2] text-white px-5 py-2.5 rounded-lg shadow-sm flex items-center font-semibold transition-colors">
                <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                Entry Baru
            </button>
        </div>
    </div>

    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
    @endif

    @if($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
        <strong class="font-bold">Transaksi Gagal!</strong>
        <ul class="list-disc pl-5 mt-1">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <!-- Data Table -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <table id="table-pembayaran" class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-100 text-gray-600 text-sm uppercase tracking-wider">
                    <th class="p-4 font-semibold">Tanggal</th>
                    <th class="p-4 font-semibold">Siswa</th>
                    <th class="p-4 font-semibold">Untuk Bulan</th>
                    <th class="p-4 font-semibold">Nominal</th>
                    <th class="p-4 font-semibold">Petugas</th>
                    <th class="p-4 font-semibold text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-700 divide-y divide-gray-100">
                @forelse($pembayarans as $pembayaran)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="p-4">{{ \Carbon\Carbon::parse($pembayaran->tgl_bayar)->format('d M Y') }}</td>
                    <td class="p-4">
                        <p class="font-medium text-gray-900">{{ $pembayaran->siswa->nama ?? 'Siswa Terhapus' }}</p>
                        <p class="text-xs text-gray-500">NISN: {{ $pembayaran->nisn }}</p>
                    </td>
                    <td class="p-4">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                            {{ $pembayaran->bulan_dibayar }} {{ $pembayaran->tahun_dibayar }}
                        </span>
                    </td>
                    <td class="p-4 font-semibold text-gray-900">Rp {{ number_format($pembayaran->jumlah_bayar, 0, ',', '.') }}</td>
                    <td class="p-4 text-sm">{{ $pembayaran->petugas->name ?? 'N/A' }}</td>
                    <td class="p-4 flex justify-center space-x-2 items-center h-full">
                        <button onclick="openEditModal('{{ $pembayaran->id }}', '{{ $pembayaran->bulan_dibayar }}', '{{ $pembayaran->tahun_dibayar }}')" class="w-8 h-8 rounded-full bg-orange-100 text-orange-500 flex items-center justify-center hover:bg-orange-200 transition-colors" title="Edit Bulan">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                        </button>
                        <form action="{{ route('pembayaran.destroy', $pembayaran->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin membatalkan transaksi ini? Menghapus transaksi berarti uang pembayaran tidak sah.');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-8 h-8 rounded-full bg-red-100 text-red-500 flex items-center justify-center hover:bg-red-200 transition-colors" title="Batal Transaksi">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="p-8 text-center text-gray-500">Belum ada transaksi pembayaran yang dilakukan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @push('modals')
    <!-- Modal Entry Transaksi Baru -->
    <div id="modal-add" style="z-index: 9999;" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden flex items-center justify-center z-50 overflow-y-auto w-full h-full">
        <div class="bg-white rounded-2xl w-full max-w-2xl p-6 shadow-xl my-8">
            <div class="flex justify-between items-center mb-5 border-b pb-3">
                <h2 class="text-xl font-bold text-gray-800 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-[#4A6CF7]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    Entry Pembayaran SPP
                </h2>
                <button type="button" onclick="document.getElementById('modal-add').classList.add('hidden')" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            
            <form action="{{ route('pembayaran.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Cari Siswa Terdaftar</label>
                    <select name="nisn" id="select-siswa" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#4A6CF7] focus:border-[#4A6CF7] block w-full p-2.5" onchange="autoFillSPP()">
                        <option value="">-- Ketik / Pilih Siswa --</option>
                        @foreach($siswas as $siswa)
                            <option value="{{ $siswa->nisn }}" data-idspp="{{ $siswa->id_spp }}" data-nominal="{{ $siswa->spp->nominal ?? 0 }}">
                                {{ $siswa->nisn }} - {{ $siswa->nama }} (Kelas: {{ $siswa->kelas->nama_kelas ?? 'N/A' }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Bulan Dibayar</label>
                        <select name="bulan_dibayar" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#4A6CF7] focus:border-[#4A6CF7] block w-full p-2.5">
                            <option value="">-- Pilih Bulan --</option>
                            <option value="Juli">Juli</option>
                            <option value="Agustus">Agustus</option>
                            <option value="September">September</option>
                            <option value="Oktober">Oktober</option>
                            <option value="November">November</option>
                            <option value="Desember">Desember</option>
                            <option value="Januari">Januari</option>
                            <option value="Februari">Februari</option>
                            <option value="Maret">Maret</option>
                            <option value="April">April</option>
                            <option value="Mei">Mei</option>
                            <option value="Juni">Juni</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tahun Dibayar</label>
                        <input type="text" name="tahun_dibayar" required maxlength="4" value="{{ date('Y') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#4A6CF7] focus:border-[#4A6CF7] block w-full p-2.5">
                    </div>
                </div>

                <!-- Hidden Input for ID SPP -->
                <input type="hidden" name="id_spp" id="input-id_spp" required>

                <div class="mb-6 p-4 bg-blue-50 rounded-xl border border-blue-100">
                    <label class="block text-sm font-medium text-blue-800 mb-1">Jumlah Harus Dibayar (Nominal SPP Siswa)</label>
                    <div class="flex">
                        <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md">
                            Rp
                        </span>
                        <input type="number" name="jumlah_bayar" id="input-nominal" required readonly class="rounded-none rounded-r-lg bg-white border border-gray-300 text-gray-900 block flex-1 min-w-0 w-full text-sm p-2.5 font-bold cursor-not-allowed">
                    </div>
                    <p class="text-xs text-blue-500 mt-2">* Nominal otomatis terisi sesuai dengan Tahun SPP yang dipilih pada profil Siswa.</p>
                </div>

                <div class="flex justify-end space-x-3 border-t pt-4">
                    <button type="button" onclick="document.getElementById('modal-add').classList.add('hidden')" class="px-4 py-2 text-gray-500 bg-gray-100 hover:bg-gray-200 rounded-lg font-medium transition-colors">Batal</button>
                    <button type="submit" class="px-5 py-2 text-white bg-[#10B981] hover:bg-[#059669] rounded-lg font-medium shadow-sm flex items-center transition-colors">
                        <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Proses Pembayaran
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit Transaksi -->
    <div id="modal-edit" style="z-index: 9999;" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden flex items-center justify-center z-50 overflow-y-auto w-full h-full">
        <div class="bg-white rounded-2xl w-full max-w-md p-6 shadow-xl my-8">
            <div class="flex justify-between items-center mb-5 border-b pb-3">
                <h2 class="text-xl font-bold text-gray-800">Edit Data Transaksi</h2>
                <button type="button" onclick="document.getElementById('modal-edit').classList.add('hidden')" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            <form id="form-edit" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Bulan Dibayar</label>
                    <select id="edit-bulan" name="bulan_dibayar" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#4A6CF7] focus:border-[#4A6CF7] block w-full p-2.5">
                        <option value="Juli">Juli</option>
                        <option value="Agustus">Agustus</option>
                        <option value="September">September</option>
                        <option value="Oktober">Oktober</option>
                        <option value="November">November</option>
                        <option value="Desember">Desember</option>
                        <option value="Januari">Januari</option>
                        <option value="Februari">Februari</option>
                        <option value="Maret">Maret</option>
                        <option value="April">April</option>
                        <option value="Mei">Mei</option>
                        <option value="Juni">Juni</option>
                    </select>
                </div>
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tahun Dibayar</label>
                    <input type="text" id="edit-tahun" name="tahun_dibayar" required maxlength="4" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#4A6CF7] focus:border-[#4A6CF7] block w-full p-2.5">
                </div>
                
                <p class="text-xs text-gray-500 mb-4">* Nominal dan Siswa tidak dapat diubah di sini. Anda harus membatalkan transaksi jika salah memasukkan siswa.</p>

                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="document.getElementById('modal-edit').classList.add('hidden')" class="px-4 py-2 text-gray-500 bg-gray-100 hover:bg-gray-200 rounded-lg font-medium transition-colors">Batal</button>
                    <button type="submit" class="px-4 py-2 text-white bg-[#4A6CF7] hover:bg-[#3451b2] rounded-lg font-medium transition-colors">Perbarui</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Fitur pintar Kasir: Autofill nominal SPP berdasarkan opsi Siswa yang dipilih
        function autoFillSPP() {
            var selectBox = document.getElementById("select-siswa");
            var selectedOption = selectBox.options[selectBox.selectedIndex];
            
            var idSpp = selectedOption.getAttribute('data-idspp');
            var nominal = selectedOption.getAttribute('data-nominal');
            
            if (idSpp && nominal) {
                document.getElementById('input-id_spp').value = idSpp;
                document.getElementById('input-nominal').value = nominal;
            } else {
                document.getElementById('input-id_spp').value = '';
                document.getElementById('input-nominal').value = '';
            }
        }

        // Modal Edit helper
        function openEditModal(id, bulan, tahun) {
            document.getElementById('edit-bulan').value = bulan;
            document.getElementById('edit-tahun').value = tahun;
            document.getElementById('form-edit').action = '/pembayaran/' + id;
            document.getElementById('modal-edit').classList.remove('hidden');
        }

        function searchTable(query, tableId) {
            const table = document.getElementById(tableId);
            const rows = table.querySelectorAll('tbody tr');
            const q = query.toLowerCase();
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(q) ? '' : 'none';
            });
        }
    </script>
    @endpush
</x-app-layout>
