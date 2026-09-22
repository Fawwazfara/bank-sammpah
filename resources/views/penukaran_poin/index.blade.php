<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Riwayat Penukaran Poin') }}
            </h2>
            <a href="{{ route('penukaran-poin.create') }}" class="bg-amber-600 hover:bg-amber-700 text-white font-bold py-2 px-4 rounded transition flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Tukar Poin
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 overflow-x-auto">
                    <table class="w-full whitespace-no-wrap min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr class="bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <th class="px-6 py-4 whitespace-nowrap text-sm">Tanggal</th>
                                <th class="px-6 py-4 whitespace-nowrap text-sm">Warga</th>
                                <th class="px-6 py-4 whitespace-nowrap text-sm">Jumlah Poin</th>
                                <th class="px-6 py-4 whitespace-nowrap text-sm">Keterangan</th>
                                <th class="px-6 py-4 whitespace-nowrap text-sm">Petugas</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($penukarans as $tukar)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-sm">{{ $tukar->created_at->format('d M Y H:i') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">{{ $tukar->warga->user->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-red-500">-{{ number_format($tukar->jumlah_poin, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $tukar->keterangan }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-sm text-gray-500">{{ $tukar->petugas->name }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="border border-gray-200 px-4 py-8 text-center text-gray-500">
                                    Belum ada data penukaran poin.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    
                    <div class="mt-4">
                        {{ $penukarans->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
