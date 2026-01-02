@extends('layout.master')

@section('title', 'Laporan Eksklusif')

@section('content')
    <div class="mb-8 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Laporan Keuangan <span class="text-amber-500">VIP</span></h1>
            <p class="text-gray-500 text-sm mt-1">Analisis mendalam kondisi finansial Anda saat ini.</p>
        </div>
        <div class="bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm font-medium shadow-lg shadow-indigo-200">
            Status: Member Premium
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">

        {{-- Chart 1: Proporsi Arus Kas --}}
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 relative overflow-hidden">
            <div class="absolute top-0 right-0 p-4 opacity-10">
                <svg class="w-16 h-16 text-indigo-600" fill="currentColor" viewBox="0 0 20 20"><path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path><path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path></svg>
            </div>
            <h3 class="text-lg font-semibold text-gray-700 mb-6">Proporsi Arus Kas</h3>
            <div class="relative h-64 w-full flex justify-center">
                <canvas id="cashflowChart"></canvas>
            </div>
            <div class="mt-4 text-center text-sm text-gray-500">
                *Visualisasi saldo saat ini
            </div>
        </div>

        {{-- Chart 2: Tren Pengeluaran (Masih Dummy Data untuk contoh) --}}
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
            <h3 class="text-lg font-semibold text-gray-700 mb-6">Tren Pengeluaran Mingguan</h3>
            <div class="relative h-64 w-full">
                <canvas id="weeklyChart"></canvas>
            </div>
        </div>
    </div>

    {{-- Insight Card --}}
    <div class="bg-gradient-to-r from-indigo-500 to-purple-600 rounded-xl shadow-lg p-8 text-white mb-8">
        <div class="flex items-start space-x-4">
            <div class="bg-white/20 p-3 rounded-lg backdrop-blur-sm">
                <svg class="w-8 h-8 text-amber-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
            </div>
            <div>
                <h3 class="text-xl font-bold mb-2">Insight Finansial AI</h3>
                <p class="text-indigo-100 leading-relaxed">
                    Total Pemasukan Anda tercatat sebesar <span class="font-bold text-white">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</span>
                    dengan total Pengeluaran <span class="font-bold text-white">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</span>.
                    @if($saldo > 0)
                        Kondisi keuangan sehat dengan surplus <span class="font-bold text-emerald-300">Rp {{ number_format($saldo, 0, ',', '.') }}</span>.
                    @else
                        Perhatian: Pengeluaran melebihi pemasukan sebesar <span class="font-bold text-rose-300">Rp {{ number_format(abs($saldo), 0, ',', '.') }}</span>.
                    @endif
                </p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // --- DATA DARI CONTROLLER ---
        // Kita ambil data PHP dan masukkan ke variabel JS
        const pemasukan = {{ $totalPemasukan }};
        const pengeluaran = {{ $totalPengeluaran }};
        const saldo = {{ $saldoChart }}; // Menggunakan saldo yang sudah divalidasi (tidak minus)

        // Konfigurasi Chart 1: Doughnut Chart (Arus Kas)
        const ctx1 = document.getElementById('cashflowChart').getContext('2d');
        new Chart(ctx1, {
            type: 'doughnut',
            data: {
                labels: ['Pemasukan', 'Pengeluaran', 'Sisa Saldo'],
                datasets: [{
                    // Masukkan variabel JS di sini
                    data: [pemasukan, pengeluaran, saldo],
                    backgroundColor: [
                        '#10b981', // Emerald (Pemasukan)
                        '#f43f5e', // Rose (Pengeluaran)
                        '#3b82f6'  // Blue (Saldo/Tabungan)
                    ],
                    borderWidth: 0,
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            usePointStyle: true,
                            padding: 20
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                if (context.parsed !== null) {
                                    // Format Rupiah di Tooltip
                                    label += new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(context.parsed);
                                }
                                return label;
                            }
                        }
                    }
                }
            }
        });

        // Konfigurasi Chart 2: Bar Chart (Mingguan)
        // Note: Data mingguan masih dummy static karena logika controller difokuskan pada Total Pemasukan/Pengeluaran
        const ctx2 = document.getElementById('weeklyChart').getContext('2d');
        new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: ['Minggu 1', 'Minggu 2', 'Minggu 3', 'Minggu 4'],
                datasets: [{
                    label: 'Pengeluaran (Rp)',
                    data: [1200000, 900000, 850000, 1500000],
                    backgroundColor: '#6366f1', // Indigo 500
                    borderRadius: 6,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: '#f3f4f6' }
                    },
                    x: {
                        grid: { display: false }
                    }
                }
            }
        });
    </script>
@endsection
