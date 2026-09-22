<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Kelola Jenis Sampah') }}
            </h2>
            <a href="{{ route('jenis-sampah.create') }}" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded transition">
                + Tambah Jenis Sampah
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
                                <th class="px-6 py-4 whitespace-nowrap text-sm">Nama Jenis</th>
                                <th class="px-6 py-4 whitespace-nowrap text-sm">Poin per Kg</th>
                                <th class="px-6 py-4 whitespace-nowrap text-sm text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($jenisSampahs as $js)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">{{ $js->nama_jenis }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-green-600 font-semibold">{{ number_format($js->poin_per_kg, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                                    <a href="{{ route('jenis-sampah.edit', $js) }}" class="text-amber-600 hover:underline mr-2">Edit</a>
                                    <form action="{{ route('jenis-sampah.destroy', $js) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus jenis sampah ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="border border-gray-200 px-4 py-8 text-center text-gray-500">
                                    Belum ada data jenis sampah.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
