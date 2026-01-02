<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->string('keterangan', 255);
            $table->date('tanggal');
            $table->bigInteger('nominal');

            // Hanya ada relasi ke kategori, tanpa penanda jenis
            $table->foreignId('kategori_id')
                  ->constrained('kategoris')
                  ->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
