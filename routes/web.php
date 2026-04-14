<?php

use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

use App\Http\Controllers\SppController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\UserController;

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        if(\Illuminate\Support\Facades\Auth::user()->role === 'siswa') {
            $siswa = \App\Models\Siswa::where('nisn', \Illuminate\Support\Facades\Auth::user()->username)->first();
            $pembayarans = \App\Models\Pembayaran::where('nisn', \Illuminate\Support\Facades\Auth::user()->username)->with(['petugas', 'spp'])->get();
            return view('dashboard_siswa', compact('siswa', 'pembayarans'));
        }

        $totalSiswa = \App\Models\Siswa::count();
        $totalKelas = \App\Models\Kelas::count();
        $totalPetugas = \App\Models\User::whereIn('role', ['admin', 'petugas'])->count();
        $totalTransaksi = \App\Models\Pembayaran::count();
        return view('dashboard', compact('totalSiswa', 'totalKelas', 'totalPetugas', 'totalTransaksi'));
    })->name('dashboard');

    // Admin Only
    Route::middleware('role:admin')->group(function () {
        Route::resource('user', UserController::class)->except(['create', 'show', 'edit']);
        Route::resource('kelas', KelasController::class)->except(['create', 'show', 'edit']);
        Route::resource('spp', SppController::class)->except(['create', 'show', 'edit']);
    });

    // Admin & Petugas
    Route::middleware('role:admin,petugas')->group(function () {
        Route::get('/pembayaran/laporan', [PembayaranController::class, 'laporan'])->name('pembayaran.laporan');
        Route::resource('siswa', SiswaController::class)->except(['create', 'show', 'edit']);
        Route::resource('pembayaran', PembayaranController::class)->except(['create', 'edit']);
    });
});
