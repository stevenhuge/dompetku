<?php

namespace App\Http\Controllers;

use App\Models\Transaksi; // [PENTING] Import Model
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
        // 1. Mengambil data dari Database, diurutkan dari yang terbaru
        $transaksi = Transaksi::orderBy('tanggal', 'desc')->get();
        // 2. Menghitung total Pemasukan & Pengeluaran menggunakan Agregat Database
        // Ini lebih efisien daripada menghitung manual dengan loop
        $totalPemasukan = Transaksi::where(
            'jenis',
            'pemasukan'
        )->sum('nominal');
        $totalPengeluaran = Transaksi::where(
            'jenis',
            'pengeluaran'
        )->sum('nominal');

        // 3. Menghitung Saldo Akhir
        $saldo = $totalPemasukan - $totalPengeluaran;
        // 4. Mengirim data ke View
        return view('transaksi.index', [
            'dataTransaksi' => $transaksi,
            'pemasukan' => $totalPemasukan,
            'pengeluaran' => $totalPengeluaran,
            'saldo' => $saldo
        ]);
    }
    public function create()
    {
        return view('transaksi.create');
    }
    public function store(Request $request)
    {
        // 1. Validasi Input
        $validated = $request->validate([
            'keterangan' => 'required|string|max:255',
            'nominal' => 'required|numeric|min:1000',
            'jenis' => 'required|in:pemasukan,pengeluaran',
            'tanggal' => 'required|date'
        ]);
        // 2. Simpan ke Database (Eloquent Mass Assignment)
        // Data $validated sudah sesuai dengan field di database
        Transaksi::create($validated);
        // 3. Redirect ke halaman utama
        return redirect('/')->with('success', 'Transaksi berhasil disimpan ke Database!');
    }
}