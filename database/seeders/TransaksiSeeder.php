<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransaksiSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('transaksis')->insert([
            [
                'keterangan' => 'Gaji Bulanan',
                'tanggal' => '2023-11-01',
                'nominal' => 5000000,
                'jenis' => 'pemasukan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'keterangan' => 'Belanja Bulanan',
                'tanggal' => '2023-11-02',
                'nominal' => 1500000,
                'jenis' => 'pengeluaran',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'keterangan' => 'Investasi Saham',
                'tanggal' => '2023-11-03',
                'nominal' => 2000000,
                'jenis' => 'pemasukan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'keterangan' => 'Tagihan Listrik',
                'tanggal' => '2023-11-04',
                'nominal' => 300000,
                'jenis' => 'pengeluaran',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'keterangan' => 'Bonus Proyek',
                'tanggal' => '2023-11-05',
                'nominal' => 1000000,
                'jenis' => 'pemasukan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'keterangan' => 'Makan di Luar',
                'tanggal' => '2023-11-06',
                'nominal' => 250000,
                'jenis' => 'pengeluaran',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Tambahkan data transaksi lainnya sebanyak 10 lagi
            [
                'keterangan' => 'Penjualan Barang Bekas',
                'tanggal' => '2023-11-07',
                'nominal' => 750000,
                'jenis' => 'pemasukan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'keterangan' => 'Biaya Transportasi',
                'tanggal' => '2023-11-08',
                'nominal' => 200000,
                'jenis' => 'pengeluaran',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'keterangan' => 'Hadiah Ulang Tahun',
                'tanggal' => '2023-11-09',
                'nominal' => 500000,
                'jenis' => 'pemasukan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'keterangan' => 'Pembelian Gadget',
                'tanggal' => '2023-11-10',
                'nominal' => 3000000,
                'jenis' => 'pengeluaran',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'keterangan' => 'Pendapatan Sampingan',
                'tanggal' => '2023-11-11',
                'nominal' => 1200000,
                'jenis' => 'pemasukan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'keterangan' => 'Biaya Kesehatan',
                'tanggal' => '2023-11-12',
                'nominal' => 400000,
                'jenis' => 'pengeluaran',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
