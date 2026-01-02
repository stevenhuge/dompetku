@extends('layout.master')
@section('title', 'Tambah Transaksi')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8">
        <h2 class="text-xl font-bold text-gray-800 mb-6">Tambah Transaksi Baru</h2>

        {{-- Error Messages --}}
        @if ($errors->any())
        <div class="mb-6 bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-lg text-sm">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('transaksi.store') }}" method="POST">
            @csrf
            <div class="space-y-5">

                {{-- Keterangan --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Keterangan Transaksi</label>
                    <input type="text" name="keterangan" value="{{ old('keterangan') }}"
                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2.5 border"
                        placeholder="Contoh: Gaji Bulanan atau Makan Siang">
                </div>

                <div class="grid grid-cols-2 gap-5">
                    {{-- Nominal --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nominal (Rp)</label>
                        <input type="number" name="nominal" value="{{ old('nominal') }}"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2.5 border"
                            placeholder="0">
                    </div>

                    {{-- Tanggal --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal</label>
                        <input type="date" name="tanggal" value="{{ old('tanggal', date('Y-m-d')) }}"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2.5 border">
                    </div>
                </div>

                {{-- Kategori (Tanpa Label Jenis) --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Pilih Kategori</label>
                    <select name="kategori_id" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2.5 border">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($kategoris as $kat)
                            <option value="{{ $kat->id }}" {{ old('kategori_id') == $kat->id ? 'selected' : '' }}>
                                {{-- Hanya menampilkan Nama Kategori --}}
                                {{ $kat->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Submit Button --}}
                <div class="pt-4">
                    <button type="submit" class="w-full bg-indigo-600 text-white font-bold py-3 px-4 rounded-lg hover:bg-indigo-700 transition duration-200">
                        Simpan Transaksi
                    </button>
                    <a href="{{ route('dashboard') }}" class="block text-center mt-3 text-sm text-gray-500 hover:text-gray-700">
                        Batal
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
