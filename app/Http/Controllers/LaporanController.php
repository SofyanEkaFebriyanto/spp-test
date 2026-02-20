<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class LaporanController extends Controller
{
    public function index(): View
    {
        $data = collect(range(1, 12))->map(fn ($i) => [
            'tanggal' => now()->subDays($i)->format('Y-m-d'),
            'nisn' => '20240' . str_pad((string) $i, 5, '0', STR_PAD_LEFT),
            'nama' => 'Siswa ' . $i,
            'kelas' => ['X RPL 1', 'XI RPL 2', 'XII TKJ 1'][$i % 3],
            'bulan' => ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'][$i % 6],
            'tahun' => 2026,
            'nominal' => 350000,
            'petugas' => 'Petugas ' . (($i % 4) + 1),
        ]);

        return view('pages.laporan.index', [
            'data' => $data,
            'classes' => ['Semua Kelas', 'X RPL 1', 'XI RPL 2', 'XII TKJ 1'],
            'summary' => [
                'total_transaksi' => $data->count(),
                'total_pemasukan' => $data->sum('nominal'),
            ],
        ]);
    }
}
