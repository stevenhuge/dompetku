<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        $data = [
            [
                'nama_kategori' => 'Makanan',
                'deskripsi'     => 'Belanja makanan harian/bulanan',
                'created_at'    => $now, 'updated_at' => $now
            ],
            [
                'nama_kategori' => 'Transportasi',
                'deskripsi'     => 'Bensin, Gojek, Angkutan Umum',
                'created_at'    => $now, 'updated_at' => $now
            ],
            [
                'nama_kategori' => 'Gaji',
                'deskripsi'     => 'Pendapatan bulanan',
                'created_at'    => $now, 'updated_at' => $now
            ],
            [
                'nama_kategori' => 'Hiburan',
                'deskripsi'     => 'Nonton, Jalan-jalan, Hobi',
                'created_at'    => $now, 'updated_at' => $now
            ],
            [
                'nama_kategori' => 'Tagihan',
                'deskripsi'     => 'Listrik, Air, Internet',
                'created_at'    => $now, 'updated_at' => $now
            ],
        ];

        DB::table('kategoris')->insert($data);
    }
}
