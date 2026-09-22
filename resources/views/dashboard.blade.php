<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold mb-4">Selamat datang, {{ Auth::user()->name }}!</h3>
                    
                    @if(Auth::user()->role === 'warga' && Auth::user()->warga)
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                            <!-- Info Poin -->
                            <div class="bg-green-50 border-l-4 border-green-500 p-6 rounded shadow-sm">
                                <h4 class="text-lg font-semibold text-green-800">Total Poin Anda</h4>
                                <p class="text-4xl font-bold text-green-600 mt-2">{{ number_format(Auth::user()->warga->poin_total, 0, ',', '.') }}</p>
                                <p class="text-sm text-green-700 mt-2">Kumpulkan terus poin dengan menyetorkan sampah yang bisa didaur ulang!</p>
                            </div>
                            
                            <!-- QR Code -->
                            <div class="bg-blue-50 border-l-4 border-blue-500 p-6 rounded shadow-sm flex flex-col items-center">
                                <h4 class="text-lg font-semibold text-blue-800 mb-4">QR Code Identitas Anda</h4>
                                <div class="bg-white p-4 rounded-xl shadow-sm inline-block">
                                    {!! \SimpleSoftwareIO\QrCode\Facades\QrCode::size(150)->generate(Auth::user()->warga->kode_unik) !!}
                                </div>
                                <p class="text-sm text-blue-700 mt-4 text-center">Tunjukkan QR Code ini kepada petugas saat Anda menyetorkan sampah atau menukarkan poin.</p>
                            </div>
                        </div>

                        <!-- Riwayat Transaksi -->
                        <div class="mt-8 bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
                            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                                <h4 class="text-lg font-bold text-gray-800">Riwayat Transaksi Terakhir</h4>
                            </div>
                            <div class="p-0">
                                @php
                                    $setorans = Auth::user()->warga->setorans()->with('jenisSampah')->latest()->take(5)->get();
                                    $penukarans = Auth::user()->warga->penukaranPoins()->latest()->take(5)->get();
                                    // Gabungkan dan urutkan
                                    $history = collect();
                                    foreach($setorans as $s) {
                                        $history->push(['type' => 'setor', 'date' => $s->created_at, 'desc' => 'Setor ' . $s->jenisSampah->nama_jenis . ' (' . $s->berat_kg . ' kg)', 'poin' => '+' . $s->poin_didapat, 'color' => 'text-green-600', 'bg' => 'bg-green-100']);
                                    }
                                    foreach($penukarans as $p) {
                                        $history->push(['type' => 'tukar', 'date' => $p->created_at, 'desc' => 'Tukar Poin: ' . $p->keterangan, 'poin' => '-' . $p->poin_ditukar, 'color' => 'text-red-600', 'bg' => 'bg-red-100']);
                                    }
                                    $history = $history->sortByDesc('date')->take(5);
                                @endphp

                                @if($history->count() > 0)
                                    <ul class="divide-y divide-gray-100">
                                        @foreach($history as $item)
                                            <li class="px-6 py-4 hover:bg-gray-50 transition flex items-center justify-between">
                                                <div class="flex items-center gap-4">
                                                    <div class="w-10 h-10 rounded-full {{ $item['bg'] }} flex items-center justify-center shrink-0">
                                                        @if($item['type'] == 'setor')
                                                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                                                        @else
                                                            <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                                                        @endif
                                                    </div>
                                                    <div>
                                                        <p class="text-sm font-semibold text-gray-800">{{ $item['desc'] }}</p>
                                                        <p class="text-xs text-gray-500">{{ $item['date']->format('d M Y H:i') }}</p>
                                                    </div>
                                                </div>
                                                <div class="font-bold {{ $item['color'] }}">
                                                    {{ $item['poin'] }} Pts
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <div class="p-8 text-center text-gray-500">
                                        Belum ada riwayat transaksi.
                                    </div>
                                @endif
                            </div>
                        </div>
                    @elseif(Auth::user()->role === 'petugas')
                        <p class="mb-4">Anda login sebagai <strong>Petugas</strong>. Silakan gunakan menu di atas untuk melayani setoran atau penukaran poin warga.</p>
                        <div class="flex gap-4 mt-6">
                            <a href="{{ route('setoran.index') }}" class="bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-lg shadow transition">Mulai Terima Setoran</a>
                            <a href="{{ route('penukaran-poin.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg shadow transition">Layani Tukar Poin</a>
                        </div>
                    @elseif(Auth::user()->role === 'admin')
                        <p class="mb-4">Anda login sebagai <strong>Admin</strong>. Anda memiliki kendali penuh atas sistem ini.</p>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
                            <a href="{{ route('admin.petugas.index') }}" class="bg-indigo-50 border border-indigo-200 p-4 rounded-lg hover:bg-indigo-100 transition text-center">
                                <h4 class="font-bold text-indigo-800">Kelola Petugas</h4>
                            </a>
                            <a href="{{ route('admin.warga.index') }}" class="bg-emerald-50 border border-emerald-200 p-4 rounded-lg hover:bg-emerald-100 transition text-center">
                                <h4 class="font-bold text-emerald-800">Kelola Warga</h4>
                            </a>
                            <a href="{{ route('laporan.index') }}" class="bg-purple-50 border border-purple-200 p-4 rounded-lg hover:bg-purple-100 transition text-center">
                                <h4 class="font-bold text-purple-800">Lihat Laporan</h4>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
