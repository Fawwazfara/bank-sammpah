<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\WargaController;
use App\Http\Controllers\JenisSampahController;
use App\Http\Controllers\SetoranController;
use App\Http\Controllers\PenukaranPoinController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\Admin\PetugasController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Admin Routes
    Route::middleware('role:admin')->group(function () {
        Route::resource('admin/petugas', PetugasController::class)->names('admin.petugas');
        Route::resource('admin/warga', WargaController::class)->names('admin.warga');
        Route::resource('admin/jenis-sampah', JenisSampahController::class)->names('jenis-sampah');
        Route::get('/admin/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    });

    // Petugas Routes
    Route::middleware('role:petugas,admin')->group(function () {
        Route::resource('petugas/setoran', SetoranController::class)->names('setoran');
        Route::resource('petugas/penukaran-poin', PenukaranPoinController::class)->names('penukaran-poin');
        
        // API for QR Scanner
        Route::get('api/warga/{kode_unik}', function ($kode_unik) {
            $warga = \App\Models\Warga::with('user')->where('kode_unik', $kode_unik)->first();
            if ($warga) {
                return response()->json(['success' => true, 'data' => $warga]);
            }
            return response()->json(['success' => false, 'message' => 'Warga tidak ditemukan'], 404);
        })->name('api.warga.qr');
    });

    // Warga Routes (implicitly accessible since dashboard is for everyone, but let's define specific ones if needed)
});

require __DIR__.'/auth.php';
