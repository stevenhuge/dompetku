<?php

namespace App\Models;

use iLluminate\Database\Eloquent\Factories\Has
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
 // Mendefinisikan kolom mana saja yang boleh diisi oleh user
 protected $fillable = [
 'keterangan',
 'tanggal',
 'nominal',
 'jenis'
 ];

}
