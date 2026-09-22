<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Halo, {{ $warga->user->name }}</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-100 text-gray-800 antialiased sm:p-4 md:p-8">
    <div class="max-w-md mx-auto bg-white sm:rounded-3xl shadow-2xl overflow-hidden min-h-screen sm:min-h-0 border border-gray-100">
        <!-- Header -->
        <div class="bg-gradient-to-br from-green-500 to-emerald-700 px-6 py-10 text-white text-center rounded-b-[40px] shadow-inner relative">
            <h1 class="text-3xl font-extrabold tracking-tight mb-1">{{ $warga->user->name }}</h1>
            <p class="text-green-100 text-sm font-medium tracking-wide uppercase opacity-80">{{ $warga->no_hp ?? 'Nasabah' }}</p>
            
            <div class="mt-8 bg-white/10 backdrop-blur-md rounded-2xl p-6 border border-white/20 shadow-lg">
                <p class="text-sm text-green-50 mb-1 font-medium">Total Poin Anda</p>
                <div class="text-5xl font-black tabular-nums tracking-tighter text-white">
                    {{ number_format($warga->poin_total, 0, ',', '.') }}
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="p-6 space-y-8 mt-4">
            
            <!-- Riwayat Setoran -->
            <section>
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                        <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"></path></svg>
                        Riwayat Setoran
                    </h2>
                </div>
                
                @if($warga->setorans->count() > 0)
                <div class="space-y-3">
                    @foreach($warga->setorans->sortByDesc('created_at')->take(5) as $setoran)
                    <div class="flex justify-between items-center bg-gray-50 p-4 rounded-2xl border border-gray-100 hover:bg-green-50 transition">
                        <div class="flex items-center gap-4">
                            <div class="bg-green-100 text-green-600 p-2 rounded-xl">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900">{{ $setoran->jenisSampah->nama_jenis }}</p>
                                <p class="text-xs text-gray-500">{{ $setoran->created_at->format('d M Y') }} • {{ $setoran->berat_kg }} kg</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="font-bold text-green-600">+{{ number_format($setoran->poin_didapat, 0, ',', '.') }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="text-center py-8 bg-gray-50 rounded-2xl border border-gray-100 border-dashed">
                    <p class="text-gray-500 text-sm">Belum ada riwayat setoran.</p>
                </div>
                @endif
            </section>

            <!-- Riwayat Penukaran -->
            <section>
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                        <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Riwayat Penukaran
                    </h2>
                </div>
                
                @if($warga->penukaranPoins->count() > 0)
                <div class="space-y-3">
                    @foreach($warga->penukaranPoins->sortByDesc('created_at')->take(5) as $tukar)
                    <div class="flex justify-between items-center bg-gray-50 p-4 rounded-2xl border border-gray-100 hover:bg-amber-50 transition">
                        <div class="flex items-center gap-4">
                            <div class="bg-amber-100 text-amber-600 p-2 rounded-xl">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900 line-clamp-1">{{ $tukar->keterangan }}</p>
                                <p class="text-xs text-gray-500">{{ $tukar->created_at->format('d M Y') }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="font-bold text-red-500">-{{ number_format($tukar->jumlah_poin, 0, ',', '.') }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="text-center py-8 bg-gray-50 rounded-2xl border border-gray-100 border-dashed">
                    <p class="text-gray-500 text-sm">Belum ada riwayat penukaran poin.</p>
                </div>
                @endif
            </section>
        </div>
        
        <div class="text-center pb-8 pt-4">
            <a href="{{ url('/') }}" class="text-xs text-gray-400 hover:text-green-600 underline">Kembali ke Beranda</a>
        </div>
    </div>
</body>
</html>
