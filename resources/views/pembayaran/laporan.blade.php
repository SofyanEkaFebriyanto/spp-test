<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pembayaran SPP - {{ date('d-m-Y') }}</title>
    <style>
        body { font-family: sans-serif; padding: 20px; line-height: 1.6; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #000; padding-bottom: 10px; }
        .header h1 { margin: 0; text-transform: uppercase; }
        .header p { margin: 5px 0; font-size: 14px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 10px; text-align: left; font-size: 12px; }
        th { background-color: #f2f2f2; }
        .footer { margin-top: 50px; text-align: right; }
        .signature { margin-top: 80px; font-weight: bold; }
        @media print {
            .no-print { display: none; }
            body { padding: 0; }
        }
    </style>
</head>
<body>
    <div class="no-print" style="margin-bottom: 20px; text-align: right;">
        <button onclick="window.print()" style="padding: 10px 20px; background: #4A6CF7; color: white; border: none; border-radius: 5px; cursor: pointer; font-weight: bold;">Cetak Sekarang</button>
        <button onclick="window.close()" style="padding: 10px 20px; background: #6c757d; color: white; border: none; border-radius: 5px; cursor: pointer; margin-left: 10px;">Tutup</button>
    </div>

    <div class="header">
        <h1>Laporan Pembayaran SPP</h1>
        <p>SMK NEGERI 7 BALEENDAH</p>
        <p>Jl. Siliwangi No. 123, Kabupaten Bandung</p>
        <p>Dicetak Pada: {{ date('d F Y H:i') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal Bayar</th>
                <th>Nama Siswa (NISN)</th>
                <th>Kelas</th>
                <th>Bulan/Tahun Dibayar</th>
                <th>Nominal Bayar</th>
                <th>Petugas</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pembayarans as $pembayaran)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ \Carbon\Carbon::parse($pembayaran->tgl_bayar)->format('d-m-Y') }}</td>
                <td>{{ $pembayaran->siswa->nama ?? 'Siswa Terhapus' }} ({{ $pembayaran->nisn }})</td>
                <td>{{ $pembayaran->siswa->kelas->nama_kelas ?? '-' }}</td>
                <td>{{ $pembayaran->bulan_dibayar }} {{ $pembayaran->tahun_dibayar }}</td>
                <td>Rp {{ number_format($pembayaran->jumlah_bayar, 0, ',', '.') }}</td>
                <td>{{ $pembayaran->petugas->name ?? 'N/A' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="text-align: center;">Tidak ada data pembayaran.</td>
            </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <th colspan="5" style="text-align: right;">Total Keseluruhan:</th>
                <th colspan="2">Rp {{ number_format($pembayarans->sum('jumlah_bayar'), 0, ',', '.') }}</th>
            </tr>
        </tfoot>
    </table>

    <div class="footer">
        <p>Bandung, {{ date('d F Y') }}</p>
        <p>Mengetahui,</p>
        <p>Kepala Sekolah / Bendahara</p>
        <div class="signature">
            (...........................................)
        </div>
    </div>

    <script>
        // Otomatis buka dialog print saat halaman dimuat (opsional)
        // window.onload = function() { window.print(); }
    </script>
</body>
</html>
