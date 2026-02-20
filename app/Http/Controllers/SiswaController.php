<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class SiswaController extends Controller
{
    public function index(): View
    {
        $data = collect(range(1, 12))->map(fn ($i) => [
            'nisn' => '20240' . str_pad((string) $i, 4, '0', STR_PAD_LEFT),
            'nama' => 'Siswa ' . $i,
            'kelas' => ['X RPL 1', 'XI RPL 2', 'XII TKJ 1'][$i % 3],
            'alamat' => 'Jl. Pendidikan No. ' . $i,
            'telp' => '08123' . str_pad((string) $i, 6, '7', STR_PAD_LEFT),
        ]);

        return view('pages.siswa.index', compact('data'));
    }
}
