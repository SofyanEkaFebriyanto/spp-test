<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembayaran;
use App\Models\Siswa;
use App\Models\Spp;
use Illuminate\Support\Facades\Auth;

class PembayaranController extends Controller
{
    public function index()
    {
        // Get all history
        $pembayarans = Pembayaran::with(['petugas', 'siswa', 'spp'])->orderBy('created_at', 'desc')->get();
        
        // Get students for the dropdown
        $siswas = Siswa::with('spp')->orderBy('nama', 'asc')->get();
        
        return view('pembayaran.index', compact('pembayarans', 'siswas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nisn' => 'required|exists:siswas,nisn',
            'bulan_dibayar' => 'required|string|max:20',
            'tahun_dibayar' => 'required|string|max:4',
            'id_spp' => 'required|exists:spps,id',
            'jumlah_bayar' => 'required|integer|min:1',
        ]);

        Pembayaran::create([
            'id_petugas' => Auth::id(),
            'nisn' => $request->nisn,
            'tgl_bayar' => now()->toDateString(),
            'bulan_dibayar' => $request->bulan_dibayar,
            'tahun_dibayar' => $request->tahun_dibayar,
            'id_spp' => $request->id_spp,
            'jumlah_bayar' => $request->jumlah_bayar,
        ]);

        return redirect()->route('pembayaran.index')->with('success', 'Transaksi pembayaran berhasil diproses.');
    }

    public function show(Pembayaran $pembayaran)
    {
        return view('pembayaran.show', compact('pembayaran'));
    }

    public function update(Request $request, Pembayaran $pembayaran)
    {
        $request->validate([
            'bulan_dibayar' => 'required|string|max:20',
            'tahun_dibayar' => 'required|string|max:4',
        ]);

        $pembayaran->update([
            'bulan_dibayar' => $request->bulan_dibayar,
            'tahun_dibayar' => $request->tahun_dibayar,
        ]);

        return redirect()->route('pembayaran.index')->with('success', 'Data transaksi berhasil diperbaiki.');
    }

    public function destroy(Pembayaran $pembayaran)
    {
        $pembayaran->delete();
        return redirect()->route('pembayaran.index')->with('success', 'Transaksi berhasil dibatalkan/dihapus.');
    }

    public function laporan()
    {
        $pembayarans = Pembayaran::with(['petugas', 'siswa', 'spp'])->orderBy('tgl_bayar', 'desc')->get();
        return view('pembayaran.laporan', compact('pembayarans'));
    }
}
