<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksis';

    // Tambahkan 'kategori_id' di sini
    protected $fillable = [
        'keterangan',
        'tanggal',
        'nominal',
        'kategori_id', // <--- WAJIB ADA
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}
