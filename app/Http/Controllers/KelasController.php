<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class KelasController extends Controller
{
    public function index(): View
    {
        $data = collect(range(1, 10))->map(fn ($i) => [
            'kode' => 'KLS-' . str_pad((string) $i, 2, '0', STR_PAD_LEFT),
            'nama' => ['X RPL', 'XI RPL', 'XII RPL', 'X TKJ', 'XI TKJ'][$i % 5],
            'kompetensi' => ['Rekayasa Perangkat Lunak', 'Teknik Komputer dan Jaringan'][$i % 2],
            'wali' => 'Bapak/Ibu Guru ' . $i,
        ]);

        return view('pages.kelas.index', compact('data'));
    }
}
