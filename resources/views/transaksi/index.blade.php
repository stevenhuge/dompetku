@extends('layout.master')
@section('title', 'Dashboard')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

{{-- 1. Kartu Statistik (Saldo, Pemasukan, Pengeluaran) --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    {{-- Total Saldo --}}
    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
        <h3 class="text-sm font-medium text-gray-500 uppercase">Total Saldo</h3>
        <p class="mt-2 text-3xl font-bold text-gray-900">Rp {{ number_format($saldo, 0, ',', '.') }}</p>
    </div>

    {{-- Pemasukan --}}
    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
        <h3 class="text-sm font-medium text-emerald-500 uppercase">Pemasukan</h3>
        <p class="mt-2 text-3xl font-bold text-emerald-600">+ Rp {{ number_format($pemasukan, 0, ',', '.') }}</p>
    </div>

    {{-- Pengeluaran --}}
    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
        <h3 class="text-sm font-medium text-rose-500 uppercase">Pengeluaran</h3>
        <p class="mt-2 text-3xl font-bold text-rose-600">- Rp {{ number_format($pengeluaran, 0, ',', '.') }}</p>
    </div>
</div>

{{-- 2. Form Pencarian --}}
<form action="{{ route('dashboard') }}" method="GET" class="mb-6 flex gap-2">
    <input type="text" name="search" placeholder="Cari keterangan..." value="{{ request('search') }}"
        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500">
    <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">Cari</button>
    @if(request('search'))
        <a href="{{ route('dashboard') }}" class="px-4 py-2 bg-gray-100 text-gray-600 rounded-lg">Reset</a>
    @endif
</form>

{{-- 3. Tabel Transaksi --}}
<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
        <h2 class="text-lg font-semibold text-gray-800">Riwayat Transaksi</h2>
        <a href="{{ route('transaksi.create') }}" class="text-sm text-indigo-600 font-medium hover:underline">Tambah Baru</a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-gray-50 text-gray-600 text-sm">
                    <th class="px-6 py-3">Tanggal</th>
                    <th class="px-6 py-3">Keterangan</th>
                    <th class="px-6 py-3">Kategori</th>
                    <th class="px-6 py-3 text-right">Nominal</th>
                    <th class="px-6 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                {{-- Menggunakan variabel $transaksis sesuai Controller --}}
                @forelse($transaksis as $item)

                {{-- Logika Penentuan Warna: Jika Kategori == 'Gaji' maka Pemasukan (Hijau), selain itu Pengeluaran (Merah) --}}
                @php
                    $isPemasukan = $item->kategori->nama_kategori === 'Gaji';
                    $badgeColor  = $isPemasukan ? 'bg-emerald-100 text-emerald-700' : 'bg-rose-100 text-rose-700';
                    $textColor   = $isPemasukan ? 'text-emerald-600' : 'text-rose-600';
                    $prefix      = $isPemasukan ? '+ ' : '- ';
                @endphp

                <tr class="hover:bg-gray-50 transition">
                    {{-- Tanggal --}}
                    <td class="px-6 py-4 text-sm text-gray-500">
                        {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}
                    </td>

                    {{-- Keterangan --}}
                    <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $item->keterangan }}</td>

                    {{-- Kategori (Badge) --}}
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $badgeColor }}">
                            {{ $item->kategori->nama_kategori }}
                        </span>
                    </td>

                    {{-- Nominal --}}
                    <td class="px-6 py-4 text-sm font-bold text-right {{ $textColor }}">
                        {{ $prefix }}Rp {{ number_format($item->nominal, 0, ',', '.') }}
                    </td>

                    {{-- Aksi --}}
                    <td class="px-6 py-4 text-center">
                        <div class="flex justify-center gap-3">
                            <a href="{{ route('transaksi.edit', $item->id) }}" class="text-indigo-600 hover:text-indigo-900">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('transaksi.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus data?')">
                                @csrf @method('DELETE')
                                <button class="text-rose-600 hover:text-rose-900">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">Belum ada data transaksi.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="px-6 py-4 border-t">
        {{ $transaksis->appends(['search' => request('search')])->links() }}
    </div>
</div>
@endsection
