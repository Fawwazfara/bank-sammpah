<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Laporan Bank Sampah') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col lg:flex-row gap-6">
            
            <!-- Chart Section -->
            <div class="w-full lg:w-2/3">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6 text-gray-900">
                        <h3 class="font-bold text-lg mb-6">Total Sampah Terkumpul per Jenis (Semua Waktu)</h3>
                        
                        <div class="relative h-80 w-full">
                            <canvas id="sampahChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Ranking Section -->
            <div class="w-full lg:w-1/3">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="font-bold text-lg mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
                            Top 10 Warga Teraktif
                        </h3>
                        
                        @if($rankingWarga->count() > 0)
                        <ul class="space-y-4">
                            @foreach($rankingWarga as $index => $warga)
                            <li class="flex items-center justify-between p-3 rounded-xl {{ $index < 3 ? 'bg-gradient-to-r from-yellow-50 to-transparent border border-yellow-100' : 'bg-gray-50' }}">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full flex items-center justify-center font-bold {{ $index == 0 ? 'bg-yellow-400 text-yellow-900' : ($index == 1 ? 'bg-gray-300 text-gray-800' : ($index == 2 ? 'bg-orange-300 text-orange-900' : 'bg-gray-200 text-gray-600')) }}">
                                        {{ $index + 1 }}
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-800">{{ $warga->user->name }}</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="font-black text-green-600">{{ number_format($warga->poin_total, 0, ',', '.') }}</p>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                        @else
                        <div class="text-center py-8 text-gray-500 text-sm">
                            Belum ada data warga.
                        </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const chartData = @json($totalSampahPerJenis);
            
            const labels = chartData.map(item => item.nama_jenis);
            const data = chartData.map(item => parseFloat(item.total_berat));
            
            const ctx = document.getElementById('sampahChart').getContext('2d');
            
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Total Berat (Kg)',
                        data: data,
                        backgroundColor: 'rgba(34, 197, 94, 0.6)',
                        borderColor: 'rgb(21, 128, 61)',
                        borderWidth: 1,
                        borderRadius: 6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Kilogram (Kg)'
                            }
                        }
                    }
                }
            });
        });
    </script>
</x-app-layout>
