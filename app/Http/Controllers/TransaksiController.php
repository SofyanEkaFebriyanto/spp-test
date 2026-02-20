<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\View\View;

class TransaksiController extends Controller
{
    public function index(Request $request): View
    {
        $students = [
            '2024000001' => ['nisn' => '2024000001', 'nama' => 'Siswa 1', 'kelas' => 'X RPL 1', 'nominal' => 350000],
            '2024000002' => ['nisn' => '2024000002', 'nama' => 'Siswa 2', 'kelas' => 'XI RPL 2', 'nominal' => 360000],
            '2024000003' => ['nisn' => '2024000003', 'nama' => 'Siswa 3', 'kelas' => 'XII TKJ 1', 'nominal' => 370000],
        ];

        $student = $request->filled('nisn') ? ($students[$request->query('nisn')] ?? null) : null;

        return view('pages.transaksi.index', [
            'student' => $student,
            'years' => [now()->year - 1, now()->year, now()->year + 1],
            'receipt' => session('receipt'),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nisn' => ['required', 'string'],
            'nama' => ['required', 'string'],
            'kelas' => ['required', 'string'],
            'bulan' => ['required', 'string'],
            'tahun' => ['required', 'integer'],
            'nominal' => ['required', 'numeric', 'min:1'],
        ]);

        $receipt = [
            ...$validated,
            'petugas' => session('user.name', 'Petugas'),
            'tanggal' => Carbon::now()->translatedFormat('d M Y H:i'),
        ];

        return redirect()
            ->route('transaksi.index', ['nisn' => $validated['nisn']])
            ->with('success', 'Pembayaran berhasil diproses.')
            ->with('receipt', $receipt);
    }
}
