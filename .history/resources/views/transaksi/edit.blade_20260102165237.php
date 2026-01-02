@extends('layout.master')
@section('title', 'Edit Transaksi')
@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-bold text-gray-800">Edit Transaksi</h2>
            <a href="{{ route('dashboard') }}" class="text-sm text-gray-500 hover:text-indigo-600">Kembali</a>
        </div>

        @if ($errors->any())
        <div class="mb-6 bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-lg text-sm">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('transaksi.update', $transaksi->id) }}" method="POST">
            @csrf
            {{-- Karena rute di web.php menggunakan POST untuk update, kita tidak wajib memakai @method('PUT') --}}
            {{-- Namun jika rute Anda diganti menjadi Route::put, tambahkan @method('PUT') di sini --}}

            <div class="space-y-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Keterangan Transaksi</label>
                    <input type="text" name="keterangan" value="{{ old('keterangan', $transaksi->keterangan) }}" 
                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2.5 border"
                        placeholder="Contoh: Beli Nasi Goreng">
                </div>

                <div class="grid grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nominal (Rp)</label>
                        <input type="number" name="nominal" value="{{ old('nominal', $transaksi->nominal) }}"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2.5 border" 
                            placeholder="0">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal</label>
                        <input type="date" name="tanggal" value="{{ old('tanggal', $transaksi->tanggal) }}"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2.5 border">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Transaksi</label>
                    <div class="flex space-x-4">
                        <label class="flex items-center p-3 border rounded-lg cursor-pointer hover:bg-gray-50 w-full {{ $transaksi->jenis == 'pemasukan' ? 'bg-indigo-50 border-indigo-200' : '' }}">
                            <input type="radio" name="jenis" value="pemasukan"
                                class="text-indigo-600 focus:ring-indigo-500"
                                {{ old('jenis', $transaksi->jenis) == 'pemasukan' ? 'checked' : '' }}>
                            <span class="ml-2 text-sm text-gray-700">Pemasukan</span>
                        </label>
                        
                        <label class="flex items-center p-3 border rounded-lg cursor-pointer hover:bg-gray-50 w-full {{ $transaksi->jenis == 'pengeluaran' ? 'bg-indigo-50 border-indigo-200' : '' }}">
                            <input type="radio" name="jenis" value="pengeluaran"
                                class="text-indigo-600 focus:ring-indigo-500"
                                {{ old('jenis', $transaksi->jenis) == 'pengeluaran' ? 'checked' : '' }}>
                            <span class="ml-2 text-sm text-gray-700">Pengeluaran</span>
                        </label>
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full bg-indigo-600 text-white font-bold py-3 px-4 rounded-lg hover:bg-indigo-700 transition duration-200">
                        Update Transaksi
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection