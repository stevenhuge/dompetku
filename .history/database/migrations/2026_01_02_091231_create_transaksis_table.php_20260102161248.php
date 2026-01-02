<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaksis', function (Blueprint $table) {
 $table->id();
 $table->string('keterangan', 255);
 $table->date('tanggal');
 $table->integer('nominal');
 $table->enum('jenis', ['pemasukan', 'pengeluaran']);
 $table->timestamps(); // created_at & updated_at
 });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
