<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Kelas;

class KelasController extends Controller
{
    public function index()
    {
        $kelases = Kelas::orderBy('nama_kelas', 'asc')->get();
        return view('kelas.index', compact('kelases'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:50',
            'kompetensi_keahlian' => 'required|string|max:50'
        ]);

        Kelas::create($request->all());
        return redirect()->route('kelas.index')->with('success', 'Data Kelas berhasil ditambahkan.');
    }

    public function update(Request $request, Kelas $kelas)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:50',
            'kompetensi_keahlian' => 'required|string|max:50'
        ]);

        $kelas->update($request->all());
        return redirect()->route('kelas.index')->with('success', 'Data Kelas berhasil diperbarui.');
    }

    public function destroy(Kelas $kelas)
    {
        $kelas->delete();
        return redirect()->route('kelas.index')->with('success', 'Data Kelas berhasil dihapus.');
    }
}
