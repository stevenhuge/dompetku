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
