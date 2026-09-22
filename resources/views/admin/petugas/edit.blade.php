<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Akun Petugas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('admin.petugas.update', $petugas) }}">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                            <input type="text" name="name" id="name" class="mt-1 block w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm" value="{{ old('name', $petugas->name) }}" required>
                            @error('name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-700">Email Login</label>
                            <input type="email" name="email" id="email" class="mt-1 block w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm" value="{{ old('email', $petugas->email) }}" required>
                            @error('email')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="p-4 bg-amber-50 rounded-lg mb-6 border border-amber-200">
                            <p class="text-sm text-amber-800 mb-4 font-medium">Kosongkan kolom password di bawah ini jika tidak ingin mengubah password.</p>
                            
                            <div class="mb-4">
                                <label for="password" class="block text-sm font-medium text-amber-900">Password Baru</label>
                                <input type="password" name="password" id="password" class="mt-1 block w-full border-amber-300 focus:border-amber-500 focus:ring-amber-500 rounded-md shadow-sm">
                                @error('password')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="password_confirmation" class="block text-sm font-medium text-amber-900">Konfirmasi Password Baru</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="mt-1 block w-full border-amber-300 focus:border-amber-500 focus:ring-amber-500 rounded-md shadow-sm">
                            </div>
                        </div>

                        <div class="flex items-center justify-end">
                            <a href="{{ route('admin.petugas.index') }}" class="text-gray-600 hover:text-gray-900 mr-4">Batal</a>
                            <button type="submit" class="bg-amber-600 hover:bg-amber-700 text-white font-bold py-2 px-4 rounded transition">
                                Update Akun
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
