<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\TransaksiController;
use App\Http\Middleware\CekLogin;
use App\Http\Middleware\CekTipeUser;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'index']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware([CekLogin::class])->group(function () {
    Route::get('/dashboard', [TransaksiController::class, 'index'])->middleware(CekLogin::class)->name('dashboard');
    Route::get('/transaksi/create', [TransaksiController::class, 'create'])->middleware(CekLogin::class)->name('transaksi.create');
    Route::post('/transaksi/store', [TransaksiController::class, 'store'])->middleware(CekLogin::class)->name('transaksi.store');
    Route::get('/transaksi')
    Route::get('/laporan', [LaporanController::class, 'index'])->middleware(CekLogin::class)->name('laporan');
});
