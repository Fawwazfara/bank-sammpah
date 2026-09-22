<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Warga & QR Code') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 flex flex-col md:flex-row items-center justify-between">
                    
                    <div class="mb-6 md:mb-0 space-y-4 flex-1">
                        <div>
                            <p class="text-sm text-gray-500">Nama Lengkap</p>
                            <p class="text-xl font-bold">{{ $warga->user->name }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">No. HP</p>
                            <p class="font-medium">{{ $warga->no_hp ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Alamat</p>
                            <p class="font-medium">{{ $warga->alamat ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Total Poin Saat Ini</p>
                            <p class="text-2xl font-black text-green-600">{{ number_format($warga->poin_total, 0, ',', '.') }}</p>
                        </div>
                    </div>

                    <div class="flex-shrink-0 bg-gray-50 p-6 rounded-2xl border border-gray-100 flex flex-col items-center justify-center">
                        <div class="bg-white p-2 rounded-xl shadow-sm mb-4">
                            {!! \SimpleSoftwareIO\QrCode\Facades\QrCode::size(200)->generate($warga->kode_unik) !!}
                        </div>
                        <p class="text-xs text-gray-400 font-mono mb-4 text-center">{{ $warga->kode_unik }}</p>
                        <button onclick="window.print()" class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold py-2 px-6 rounded-full shadow transition flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                            Cetak QR
                        </button>
                        <p class="text-[10px] text-gray-500 mt-3 text-center max-w-[200px]">Cetak QR ini dan berikan ke warga untuk disimpan.</p>
                    </div>

                </div>
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-100">
                    <a href="{{ route('admin.warga.index') }}" class="text-blue-600 hover:underline text-sm font-medium">&larr; Kembali ke Daftar Warga</a>
                </div>
            </div>
        </div>
    </div>
    
    <style>
        @media print {
            body * {
                visibility: hidden;
            }
            .p-6.text-gray-900, .p-6.text-gray-900 * {
                visibility: visible;
            }
            .p-6.text-gray-900 {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
            }
            button {
                display: none !important;
            }
        }
    </style>
</x-app-layout>
