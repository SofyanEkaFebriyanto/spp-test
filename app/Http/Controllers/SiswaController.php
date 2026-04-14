<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Spp;
use App\Models\User;

class SiswaController extends Controller
{
    public function index()
    {
        // Get all siswas with their related kelas and spp
        $siswas = Siswa::with(['kelas', 'spp'])->orderBy('nama', 'asc')->get();
        
        // Pass classes and spps to the view for the forms
        $kelases = Kelas::orderBy('nama_kelas', 'asc')->get();
        $spps = Spp::orderBy('tahun', 'desc')->get();
        
        return view('siswa.index', compact('siswas', 'kelases', 'spps'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nisn' => 'required|string|size:10|unique:siswas,nisn',
            'nis' => 'required|string|size:8|unique:siswas,nis',
            'nama' => 'required|string|max:35',
            'id_kelas' => 'required|exists:kelas,id',
            'alamat' => 'required|string',
            'no_telp' => 'required|string|max:13',
            'id_spp' => 'required|exists:spps,id',
        ]);

        Siswa::create($request->all());

        if(!User::where('username', $request->nisn)->exists()) {
            User::create([
                'name' => $request->nama,
                'username' => $request->nisn,
                'password' => $request->nisn,
                'role' => 'siswa'
            ]);
        }

        return redirect()->route('siswa.index')->with('success', 'Data Siswa berhasil ditambahkan.');
    }

    public function update(Request $request, $nisn)
    {
        $siswa = Siswa::findOrFail($nisn);

        $request->validate([
            'nis' => 'required|string|size:8|unique:siswas,nis,'.$siswa->nisn.',nisn',
            'nama' => 'required|string|max:35',
            'id_kelas' => 'required|exists:kelas,id',
            'alamat' => 'required|string',
            'no_telp' => 'required|string|max:13',
            'id_spp' => 'required|exists:spps,id',
        ]);

        $siswa->update($request->except(['nisn'])); // nisn is PK, typically not updatable, but just in case
        
        User::where('username', $siswa->nisn)->update([
            'name' => $request->nama
        ]);

        return redirect()->route('siswa.index')->with('success', 'Data Siswa berhasil diperbarui.');
    }

    public function destroy($nisn)
    {
        $siswa = Siswa::findOrFail($nisn);
        User::where('username', $siswa->nisn)->delete();
        $siswa->delete();
        return redirect()->route('siswa.index')->with('success', 'Data Siswa berhasil dihapus.');
    }
}
