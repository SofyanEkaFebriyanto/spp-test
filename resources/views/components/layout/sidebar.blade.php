@php
    $menus = [
        ['label' => 'Dashboard', 'route' => 'dashboard'],
        ['label' => 'Siswa', 'route' => 'siswa.index'],
        ['label' => 'Kelas', 'route' => 'kelas.index'],
        ['label' => 'SPP', 'route' => 'spp.index'],
        ['label' => 'Petugas', 'route' => 'petugas.index'],
        ['label' => 'Transaksi', 'route' => 'transaksi.index'],
        ['label' => 'History', 'route' => 'history.index'],
        ['label' => 'Laporan', 'route' => 'laporan.index'],
    ];
@endphp
<aside class="fixed inset-y-0 left-0 w-64 bg-white border-r border-slate-200 hidden md:block">
    <div class="h-16 px-6 flex items-center border-b border-slate-200">
        <span class="font-bold text-blue-800">SPP Sekolah</span>
    </div>
    <nav class="p-4 space-y-1">
        @foreach($menus as $menu)
            <a href="{{ route($menu['route']) }}" class="flex items-center gap-2 px-3 py-2 rounded-md text-sm {{ request()->routeIs($menu['route']) ? 'bg-blue-50 text-blue-800 font-semibold' : 'text-slate-700 hover:bg-slate-100' }}">
                <span>•</span>{{ $menu['label'] }}
            </a>
        @endforeach
    </nav>
</aside>
