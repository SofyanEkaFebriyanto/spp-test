<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('pages.dashboard', [
            'stats' => [
                'total_siswa' => 324,
                'transaksi_bulan_ini' => 198,
                'pemasukan_bulan_ini' => 89100000,
                'belum_bayar' => 46,
            ],
            'bars' => [40, 55, 62, 48, 70, 85, 66, 80, 72, 90, 76, 88],
        ]);
    }
}
