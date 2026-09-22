<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Riwayat Setoran') }}
            </h2>
            <a href="{{ route('setoran.create') }}" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded transition flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Input Setoran
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
                                <th class="px-6 py-4 whitespace-nowrap text-sm">Jenis Sampah</th>
                                <th class="px-6 py-4 whitespace-nowrap text-sm">Berat (Kg)</th>
                                <th class="px-6 py-4 whitespace-nowrap text-sm">Poin Didapat</th>
                                <th class="px-6 py-4 whitespace-nowrap text-sm">Petugas</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($setorans as $setoran)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-sm">{{ $setoran->created_at->format('d M Y H:i') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">{{ $setoran->warga->user->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $setoran->jenisSampah->nama_jenis }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $setoran->berat_kg }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-green-600">+{{ number_format($setoran->poin_didapat, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-sm text-gray-500">{{ $setoran->petugas->name }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="border border-gray-200 px-4 py-8 text-center text-gray-500">
                                    Belum ada data setoran.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    
                    <div class="mt-4">
                        {{ $setorans->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
