<x-app-layout>
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-800 tracking-tight">Data Kelas</h1>
            <p class="text-gray-500 mt-1 font-medium">Mengelola Data dan Informasi Jurusan Kelas</p>
        </div>
        <div class="flex space-x-3">
            <button onclick="document.getElementById('modal-add').classList.remove('hidden')" class="bg-[#4A6CF7] hover:bg-[#3451b2] text-white px-5 py-2.5 rounded-lg shadow-sm flex items-center font-semibold transition-colors">
                <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                Tambah
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
        <ul class="list-disc pl-5">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-100 text-gray-600 text-sm uppercase tracking-wider">
                    <th class="p-4 font-semibold">Nama Kelas</th>
                    <th class="p-4 font-semibold">Kompetensi Keahlian</th>
                    <th class="p-4 font-semibold text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-700 divide-y divide-gray-100">
                @forelse($kelases as $kelas)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="p-4 font-medium">{{ $kelas->nama_kelas }}</td>
                    <td class="p-4">{{ $kelas->kompetensi_keahlian }}</td>
                    <td class="p-4 flex justify-center space-x-2">
                        <button onclick="openEditModal('{{ $kelas->id }}', '{{ addslashes($kelas->nama_kelas) }}', '{{ addslashes($kelas->kompetensi_keahlian) }}')" class="w-8 h-8 rounded-full bg-orange-100 text-orange-500 flex items-center justify-center hover:bg-orange-200 transition-colors" title="Edit">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                        </button>
                        <form action="{{ route('kelas.destroy', $kelas->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus data kelas ini? Jika ada siswa di kelas ini, penghapusan bisa dibatalkan oleh database constraints.');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-8 h-8 rounded-full bg-red-100 text-red-500 flex items-center justify-center hover:bg-red-200 transition-colors" title="Hapus">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="p-8 text-center text-gray-500">Belum ada data Kelas tersedia.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @push('modals')
    <!-- Modal Tambah Kelas -->
    <div id="modal-add" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden flex items-center justify-center z-50">
        <div class="bg-white rounded-2xl w-full max-w-md p-6 shadow-xl">
            <div class="flex justify-between items-center mb-5">
                <h2 class="text-xl font-bold text-gray-800">Tambah Data Kelas</h2>
                <button onclick="document.getElementById('modal-add').classList.add('hidden')" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            <form action="{{ route('kelas.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Kelas</label>
                    <input type="text" name="nama_kelas" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#4A6CF7] focus:border-[#4A6CF7] block w-full p-2.5" placeholder="Contoh: X RPL 1">
                </div>
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kompetensi Keahlian</label>
                    <input type="text" name="kompetensi_keahlian" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#4A6CF7] focus:border-[#4A6CF7] block w-full p-2.5" placeholder="Contoh: Rekayasa Perangkat Lunak">
                </div>
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="document.getElementById('modal-add').classList.add('hidden')" class="px-4 py-2 text-gray-500 bg-gray-100 hover:bg-gray-200 rounded-lg font-medium transition-colors">Batal</button>
                    <button type="submit" class="px-4 py-2 text-white bg-[#4A6CF7] hover:bg-[#3451b2] rounded-lg font-medium transition-colors">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit Kelas -->
    <div id="modal-edit" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden flex items-center justify-center z-50">
        <div class="bg-white rounded-2xl w-full max-w-md p-6 shadow-xl">
            <div class="flex justify-between items-center mb-5">
                <h2 class="text-xl font-bold text-gray-800">Edit Data Kelas</h2>
                <button onclick="document.getElementById('modal-edit').classList.add('hidden')" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            <form id="form-edit" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Kelas</label>
                    <input type="text" id="edit-nama_kelas" name="nama_kelas" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#4A6CF7] focus:border-[#4A6CF7] block w-full p-2.5">
                </div>
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kompetensi Keahlian</label>
                    <input type="text" id="edit-kompetensi_keahlian" name="kompetensi_keahlian" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#4A6CF7] focus:border-[#4A6CF7] block w-full p-2.5">
                </div>
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="document.getElementById('modal-edit').classList.add('hidden')" class="px-4 py-2 text-gray-500 bg-gray-100 hover:bg-gray-200 rounded-lg font-medium transition-colors">Batal</button>
                    <button type="submit" class="px-4 py-2 text-white bg-[#4A6CF7] hover:bg-[#3451b2] rounded-lg font-medium transition-colors">Perbarui</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openEditModal(id, nama_kelas, kompetensi_keahlian) {
            document.getElementById('edit-nama_kelas').value = nama_kelas;
            document.getElementById('edit-kompetensi_keahlian').value = kompetensi_keahlian;
            document.getElementById('form-edit').action = '/kelas/' + id;
            document.getElementById('modal-edit').classList.remove('hidden');
        }
    </script>
    @endpush
</x-app-layout>
