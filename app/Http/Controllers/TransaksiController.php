<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Kategori;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        // 1. Ambil Data Transaksi + Relasi Kategori
        $query = Transaksi::with('kategori');

        if ($search) {
            $query->where('keterangan', 'like', '%' . $search . '%');
        }

        // Simpan ke variabel $transaksis (agar sesuai dengan index.blade.php)
        $transaksis = $query->orderBy('tanggal', 'desc')->paginate(10);

        // 2. LOGIKA HITUNG SALDO (Tanpa Kolom Jenis)
        // Karena kolom 'jenis' sudah dihapus, kita hitung manual berdasarkan Nama Kategori.
        // Asumsi: Hanya kategori "Gaji" yang dianggap Pemasukan.

        $pemasukan = Transaksi::whereHas('kategori', function ($q) {
            $q->where('nama_kategori', 'Gaji');
        })
        ->when($search, function ($q) use ($search) {
            $q->where('keterangan', 'like', '%' . $search . '%');
        })->sum('nominal');

        // Sisanya (selain Gaji) dianggap Pengeluaran
        $pengeluaran = Transaksi::whereHas('kategori', function ($q) {
            $q->where('nama_kategori', '!=', 'Gaji');
        })
        ->when($search, function ($q) use ($search) {
            $q->where('keterangan', 'like', '%' . $search . '%');
        })->sum('nominal');

        $saldo = $pemasukan - $pengeluaran;

        return view('transaksi.index', compact('transaksis', 'pemasukan', 'pengeluaran', 'saldo'));
    }

    public function create()
    {
        // Ambil semua kategori untuk dropdown di form tambah
        $kategoris = Kategori::all();
        return view('transaksi.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'keterangan'  => 'required|string|max:255',
            'nominal'     => 'required|numeric|min:1000',
            // Validasi kategori_id wajib ada di tabel kategoris
            'kategori_id' => 'required|exists:kategoris,id',
            'tanggal'     => 'required|date'
        ]);

        Transaksi::create($validated);

        // Redirect ke index transaksi
        return redirect()->route('dashboard')->with('success', 'Transaksi berhasil disimpan!');
    }

    public function edit($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $kategoris = Kategori::all(); // Data kategori untuk dropdown edit

        return view('transaksi.edit', compact('transaksi', 'kategoris'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'keterangan'  => 'required|string|max:255',
            'nominal'     => 'required|numeric|min:1000',
            'kategori_id' => 'required|exists:kategoris,id',
            'tanggal'     => 'required|date'
        ]);

        $transaksi = Transaksi::findOrFail($id);
        $transaksi->update($validated);

        return redirect()->route('dashboard')->with('success', 'Data transaksi berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->delete();

        return redirect()->route('dashboard')->with('success', 'Transaksi berhasil dihapus!');
    }
}
