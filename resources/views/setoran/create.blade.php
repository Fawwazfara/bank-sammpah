<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Input Setoran Baru') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="setoranForm()">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 flex flex-col md:flex-row gap-6">
            
            <!-- Scanner Section -->
            <div class="w-full md:w-1/2">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 flex flex-col items-center justify-center">
                        <h3 class="font-bold text-lg mb-4 text-center">Scan QR Warga</h3>
                        <div x-show="!wargaId" id="reader" class="w-full max-w-sm rounded-xl overflow-hidden border-4 border-dashed border-gray-300"></div>
                        <p class="text-sm text-gray-500 mt-4 text-center" x-show="!wargaId">Arahkan kamera ke QR Code milik warga</p>
                        
                        <div x-show="wargaId" class="mt-4 p-6 bg-gradient-to-r from-green-50 to-emerald-100 border border-green-200 rounded-xl w-full text-center shadow-inner" style="display: none;">
                            <div class="w-16 h-16 bg-green-500 text-white rounded-full flex items-center justify-center mx-auto mb-3 shadow-md">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <h4 class="text-green-800 font-bold text-xl">Warga Terdeteksi!</h4>
                            <p class="text-green-700 mt-2 text-lg font-medium" x-text="wargaName"></p>
                            <button type="button" @click="resetScanner()" class="mt-4 text-sm text-green-600 hover:text-green-800 underline">Batalkan & Scan Ulang</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Section -->
            <div class="w-full md:w-1/2">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <form method="POST" action="{{ route('setoran.store') }}">
                            @csrf
                            
                            <input type="hidden" name="warga_id" x-model="wargaId" required>
                            
                            <div class="mb-4" x-show="!wargaId">
                                <div class="p-4 bg-amber-50 border border-amber-200 rounded-lg text-amber-700 text-sm text-center">
                                    Silakan scan QR Code warga terlebih dahulu di kolom sebelah kiri untuk melanjutkan.
                                </div>
                            </div>
                            
                            <div x-show="wargaId" style="display: none;">

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Sampah</label>
                                <select name="jenis_sampah_id" x-model="jenisId" @change="calculate()" class="block w-full border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm" required>
                                    <option value="">-- Pilih Jenis --</option>
                                    @foreach($jenisSampahs as $js)
                                        <option value="{{ $js->id }}" data-poin="{{ $js->poin_per_kg }}">{{ $js->nama_jenis }} ({{ $js->poin_per_kg }} Poin/Kg)</option>
                                    @endforeach
                                </select>
                                @error('jenis_sampah_id')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Berat (Kg)</label>
                                <input type="number" step="0.01" min="0.01" name="berat_kg" x-model="berat" @input="calculate()" class="block w-full border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm" required placeholder="Contoh: 1.5">
                                @error('berat_kg')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-6 p-4 bg-gray-50 border border-gray-200 rounded-xl">
                                <p class="text-sm text-gray-500">Estimasi Poin Didapat</p>
                                <p class="text-3xl font-black text-green-600 mt-1" x-text="estimasiPoin">0</p>
                            </div>

                            <div class="flex items-center justify-end">
                                <button type="submit" class="w-full bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white font-bold py-3 px-4 rounded-xl shadow-lg transition text-lg" :disabled="!wargaId" :class="{'opacity-50 cursor-not-allowed': !wargaId}">
                                    Simpan Setoran
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
            Alpine.data('setoranForm', () => ({
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
                    this.jenisId = '';
                    this.berat = '';
                    this.estimasiPoin = 0;
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

                calculate() {
                    if (!this.jenisId || !this.berat) {
                        this.estimasiPoin = 0;
                        return;
                    }
                    
                    const select = document.querySelector('select[name="jenis_sampah_id"]');
                    const option = select.options[select.selectedIndex];
                    const poinPerKg = parseInt(option.getAttribute('data-poin'));
                    
                    this.estimasiPoin = Math.floor(parseFloat(this.berat) * poinPerKg);
                    if (isNaN(this.estimasiPoin)) this.estimasiPoin = 0;
                }
            }))
        })
    </script>
</x-app-layout>
