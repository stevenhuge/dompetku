@extends('layout.master')
@section('title', 'Edit Transaksi')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8">
        <h2 class="text-xl font-bold text-gray-800 mb-6">Edit Transaksi</h2>

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

        <form action="{{ route('transaksi.update', $transaksi->id) }}" method="POST">
            @csrf
            @method('PUT') {{-- Wajib untuk Update data --}}

            <div class="space-y-5">

                {{-- Keterangan --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Keterangan Transaksi</label>
                    {{-- Perhatikan value: old('keterangan', $transaksi->keterangan) --}}
                    <input type="text" name="keterangan" value="{{ old('keterangan', $transaksi->keterangan) }}"
                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2.5 border">
                </div>

                <div class="grid grid-cols-2 gap-5">
                    {{-- Nominal --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nominal (Rp)</label>
                        <input type="number" name="nominal" value="{{ old('nominal', $transaksi->nominal) }}"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2.5 border">
                    </div>

                    {{-- Tanggal --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal</label>
                        <input type="date" name="tanggal" value="{{ old('tanggal', $transaksi->tanggal) }}"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2.5 border">
                    </div>
                </div>

                {{-- Kategori Dropdown --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Pilih Kategori</label>
                    <select name="kategori_id" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2.5 border">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($kategoris as $kategori)
                            <option value="{{ $kategori->id }}"
                                {{-- Logika Selected: Jika old input sama ATAU data database sama dengan ID loop --}}
                                {{ old('kategori_id', $transaksi->kategori_id) == $kategori->id ? 'selected' : '' }}>
                                {{ $kategori->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Tombol Aksi --}}
                <div class="pt-4 flex gap-3">
                    <button type="submit" class="flex-1 bg-indigo-600 text-white font-bold py-3 px-4 rounded-lg hover:bg-indigo-700 transition duration-200">
                        Update Transaksi
                    </button>
                    <a href="{{ route('dashboard') }}" class="flex-none bg-gray-100 text-gray-700 font-semibold py-3 px-6 rounded-lg hover:bg-gray-200 transition duration-200 text-center">
                        Batal
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
