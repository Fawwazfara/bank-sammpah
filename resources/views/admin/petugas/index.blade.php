<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Kelola Petugas') }}
            </h2>
            <a href="{{ route('admin.petugas.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition">
                + Tambah Petugas
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
                    <table class="w-full whitespace-no-wrap border-collapse border border-gray-200">
                        <thead>
                            <tr class="bg-gray-100 text-left">
                                <th class="border border-gray-200 px-4 py-2">Nama Lengkap</th>
                                <th class="border border-gray-200 px-4 py-2">Email</th>
                                <th class="border border-gray-200 px-4 py-2 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($petugas as $p)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="border border-gray-200 px-4 py-2 font-medium">{{ $p->name }}</td>
                                <td class="border border-gray-200 px-4 py-2">{{ $p->email }}</td>
                                <td class="border border-gray-200 px-4 py-2 text-center">
                                    <a href="{{ route('admin.petugas.edit', $p) }}" class="text-amber-600 hover:underline mr-2">Edit</a>
                                    <form action="{{ route('admin.petugas.destroy', $p) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus akun petugas ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="border border-gray-200 px-4 py-8 text-center text-gray-500">
                                    Belum ada data petugas.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    
                    <div class="mt-4">
                        {{ $petugas->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
