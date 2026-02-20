<?php

namespace App\Http\Controllers;

use Illuminate\Support\Carbon;
use Illuminate\View\View;

class HistoryController extends Controller
{
    public function index(): View
    {
        $classes = ['X RPL 1', 'XI RPL 2', 'XII TKJ 1'];
        $months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni'];

        $data = collect(range(1, 20))->map(function ($i) use ($classes, $months) {
            return [
                'tanggal' => Carbon::now()->subDays($i)->format('Y-m-d'),
                'nisn' => '20240' . str_pad((string) $i, 5, '0', STR_PAD_LEFT),
                'nama' => 'Siswa ' . $i,
                'kelas' => $classes[$i % 3],
                'bulan' => $months[$i % count($months)],
                'tahun' => 2026,
                'nominal' => 350000,
                'petugas' => 'Petugas ' . (($i % 5) + 1),
            ];
        });

        return view('pages.history.index', ['data' => $data, 'classes' => $classes]);
    }
}
