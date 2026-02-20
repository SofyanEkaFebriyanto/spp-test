<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class SppController extends Controller
{
    public function index(): View
    {
        $data = collect(range(1, 10))->map(fn ($i) => [
            'tahun' => 2020 + $i,
            'nominal' => 250000 + ($i * 10000),
            'keterangan' => 'SPP Tahun Ajaran ' . (2020 + $i) . '/' . (2021 + $i),
        ]);

        return view('pages.spp.index', compact('data'));
    }
}
