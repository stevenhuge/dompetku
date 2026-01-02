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
 // 2. Menghitung total Pemasukan & Pengeluaran menggunakan Agregat
Database
 // Ini lebih efisien daripada menghitung manual dengan loop
 $totalPemasukan = Transaksi::where('jenis',
'pemasukan')->sum('nominal');
 $totalPengeluaran = Transaksi::where('jenis',
'pengeluaran')->sum('nominal');

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