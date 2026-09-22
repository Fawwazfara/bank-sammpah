<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Jenis Sampah') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('jenis-sampah.store') }}">
                        @csrf
                        
                        <div class="mb-4">
                            <label for="nama_jenis" class="block text-sm font-medium text-gray-700">Nama Jenis Sampah</label>
                            <input type="text" name="nama_jenis" id="nama_jenis" class="mt-1 block w-full border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm" value="{{ old('nama_jenis') }}" required placeholder="Contoh: Plastik, Kertas, Logam">
                            @error('nama_jenis')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="poin_per_kg" class="block text-sm font-medium text-gray-700">Poin per Kg</label>
                            <input type="number" min="0" name="poin_per_kg" id="poin_per_kg" class="mt-1 block w-full border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm" value="{{ old('poin_per_kg') }}" required placeholder="Contoh: 1000">
                            @error('poin_per_kg')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('jenis-sampah.index') }}" class="text-gray-600 hover:text-gray-900 mr-4">Batal</a>
                            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded transition">
                                Simpan Data
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
