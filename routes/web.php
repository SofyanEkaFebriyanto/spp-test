<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SppController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

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
        $recentPembayarans = \App\Models\Pembayaran::with(['petugas', 'siswa', 'spp'])->orderBy('created_at', 'desc')->take(5)->get();
        return view('dashboard', compact('totalSiswa', 'totalKelas', 'totalPetugas', 'totalTransaksi', 'recentPembayarans'));
    })->name('dashboard');

    // Admin Only — CRUD Siswa, Kelas, SPP, Petugas, Laporan
    Route::middleware('role:admin')->group(function () {
        Route::resource('user', UserController::class)->except(['create', 'show', 'edit']);
        Route::resource('kelas', KelasController::class)->except(['create', 'show', 'edit']);
        Route::resource('spp', SppController::class)->except(['create', 'show', 'edit']);
        Route::resource('siswa', SiswaController::class)->except(['create', 'show', 'edit']);
        Route::get('/pembayaran/laporan', [PembayaranController::class, 'laporan'])->name('pembayaran.laporan');
    });

    // Admin & Petugas — Entri transaksi pembayaran
    Route::middleware('role:admin,petugas')->group(function () {
        Route::resource('pembayaran', PembayaranController::class)->except(['create', 'show', 'edit']);
    });
});
