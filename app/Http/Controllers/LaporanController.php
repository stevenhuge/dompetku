<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi; // Import Model Transaksi

class LaporanController extends Controller
{
    public function index()
    {
        // 1. Hitung Total Pemasukan (Logika: Kategori == 'Gaji')
        $totalPemasukan = Transaksi::whereHas('kategori', function ($q) {
            $q->where('nama_kategori', 'Gaji');
        })->sum('nominal');

        // 2. Hitung Total Pengeluaran (Logika: Kategori != 'Gaji')
        $totalPengeluaran = Transaksi::whereHas('kategori', function ($q) {
            $q->where('nama_kategori', '!=', 'Gaji');
        })->sum('nominal');

        // 3. Hitung Saldo (Tabungan)
        $saldo = $totalPemasukan - $totalPengeluaran;

        // Pastikan saldo tidak negatif untuk visualisasi Chart (Chart tidak bisa render minus)
        $saldoChart = $saldo < 0 ? 0 : $saldo;

        return view('transaksi.laporan', compact('totalPemasukan', 'totalPengeluaran', 'saldo', 'saldoChart'));
    }
}
