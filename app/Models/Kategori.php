<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategoris';

    // Hapus 'jenis' dari fillable
    protected $fillable = ['nama_kategori', 'deskripsi'];

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class);
    }
}
