<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Spp;

class SppController extends Controller
{
    public function index()
    {
        $spps = Spp::orderBy('tahun', 'desc')->get();
        return view('spp.index', compact('spps'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tahun' => 'required|integer|unique:spps,tahun',
            'nominal' => 'required|integer|min:0'
        ]);

        Spp::create($request->all());
        return redirect()->route('spp.index')->with('success', 'Data SPP berhasil ditambahkan.');
    }

    public function update(Request $request, Spp $spp)
    {
        $request->validate([
            'tahun' => 'required|integer|unique:spps,tahun,'.$spp->id,
            'nominal' => 'required|integer|min:0'
        ]);

        $spp->update($request->all());
        return redirect()->route('spp.index')->with('success', 'Data SPP berhasil diperbarui.');
    }

    public function destroy(Spp $spp)
    {
        $spp->delete();
        return redirect()->route('spp.index')->with('success', 'Data SPP berhasil dihapus.');
    }
}
