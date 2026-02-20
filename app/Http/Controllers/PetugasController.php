<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class PetugasController extends Controller
{
    public function index(): View
    {
        $data = collect(range(1, 10))->map(fn ($i) => [
            'username' => 'petugas' . $i,
            'nama' => 'Petugas ' . $i,
            'email' => 'petugas' . $i . '@sekolah.test',
            'level' => $i % 4 === 0 ? 'admin' : 'petugas',
        ]);

        return view('pages.petugas.index', compact('data'));
    }
}
