<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tukar Poin Warga') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="tukarForm()">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 flex flex-col md:flex-row gap-6">
            
            <!-- Scanner Section -->
            <div class="w-full md:w-1/2">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 flex flex-col items-center justify-center">
                        <h3 class="font-bold text-lg mb-4 text-center">Scan QR Warga</h3>
                        <div x-show="!wargaId" id="reader" class="w-full max-w-sm rounded-xl overflow-hidden border-4 border-dashed border-gray-300"></div>
                        <p class="text-sm text-gray-500 mt-4 text-center" x-show="!wargaId">Arahkan kamera ke QR Code milik warga</p>
                        
                        <div x-show="wargaId" class="mt-4 p-6 bg-gradient-to-r from-amber-50 to-orange-100 border border-amber-200 rounded-xl w-full text-center shadow-inner" style="display: none;">
                            <div class="w-16 h-16 bg-amber-500 text-white rounded-full flex items-center justify-center mx-auto mb-3 shadow-md">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <h4 class="text-amber-800 font-bold text-xl">Warga Terdeteksi!</h4>
                            <p class="text-amber-700 mt-2 text-lg font-medium" x-text="wargaName"></p>
                            <button type="button" @click="resetScanner()" class="mt-4 text-sm text-amber-600 hover:text-amber-800 underline">Batalkan & Scan Ulang</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Section -->
            <div class="w-full md:w-1/2">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        @if ($errors->any())
                            <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-4">
                                <ul class="list-disc list-inside text-sm text-red-600">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('penukaran-poin.store') }}">
                            @csrf
                            
                            <input type="hidden" name="warga_id" x-model="wargaId" required>
                            
                            <div class="mb-4" x-show="!wargaId">
                                <div class="p-4 bg-amber-50 border border-amber-200 rounded-lg text-amber-700 text-sm text-center">
                                    Silakan scan QR Code warga terlebih dahulu di kolom sebelah kiri untuk melanjutkan.
                                </div>
                            </div>
                            
                            <div x-show="wargaId" style="display: none;">

                            <div class="mb-6 p-4 bg-gray-50 border border-gray-200 rounded-xl" x-show="wargaId">
                                <p class="text-sm text-gray-500">Poin Saat Ini</p>
                                <p class="text-2xl font-bold text-gray-800" x-text="poinWarga">0</p>
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Jumlah Poin Ditukar</label>
                                <input type="number" min="1" name="jumlah_poin" x-model="jumlahTukar" class="block w-full border-gray-300 focus:border-amber-500 focus:ring-amber-500 rounded-md shadow-sm" required placeholder="Contoh: 5000">
                            </div>

                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Keterangan Penukaran</label>
                                <textarea name="keterangan" rows="3" class="block w-full border-gray-300 focus:border-amber-500 focus:ring-amber-500 rounded-md shadow-sm" required placeholder="Contoh: Sembako beras 5kg"></textarea>
                            </div>

                            <div class="flex items-center justify-end">
                                <button type="submit" class="w-full bg-gradient-to-r from-amber-500 to-orange-600 hover:from-amber-600 hover:to-orange-700 text-white font-bold py-3 px-4 rounded-xl shadow-lg transition text-lg" :disabled="!wargaId || jumlahTukar > poinWarga" :class="{'opacity-50 cursor-not-allowed': (!wargaId || parseInt(jumlahTukar) > parseInt(poinWarga))}">
                                    Tukar Poin
                                </button>
                            </div>
                            </div> <!-- End x-show="wargaId" wrapper -->
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- HTML5 QR Code Scanner -->
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('tukarForm', () => ({
                wargaName: '',
                html5QrCode: null,

                init() {
                    this.startScanner();
                },
                
                startScanner() {
                    this.html5QrCode = new Html5Qrcode("reader");
                    const config = { fps: 10, qrbox: { width: 250, height: 250 } };

                    this.html5QrCode.start({ facingMode: "environment" }, config, (decodedText, decodedResult) => {
                        this.processQR(decodedText);
                    }).catch(err => {
                        console.log("Error starting QR Code scanner:", err);
                    });
                },
                
                resetScanner() {
                    this.wargaId = '';
                    this.wargaName = '';
                    this.poinWarga = 0;
                    this.jumlahTukar = '';
                    this.startScanner();
                },

                processQR(kodeUnik) {
                    // Hentikan scanner sementara
                    this.html5QrCode.stop().then(() => {
                        // Fetch data from API
                        fetch(`/api/warga/${kodeUnik}`)
                            .then(res => res.json())
                            .then(data => {
                                if (data.success) {
                                    this.wargaId = data.data.id;
                                    this.wargaName = data.data.user.name;
                                    this.poinWarga = data.data.poin_total;
                                } else {
                                    alert("QR Code tidak dikenali sebagai Warga terdaftar!");
                                    this.startScanner();
                                }
                            })
                            .catch(err => {
                                alert("Terjadi kesalahan jaringan.");
                                this.startScanner();
                            });
                    });
                },
            }))
        })
    </script>
</x-app-layout>
