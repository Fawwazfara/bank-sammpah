<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use Illuminate\Http\Request;

class PublicWargaController extends Controller
{
    public function show($kode_unik)
    {
        $warga = Warga::with(['setorans.jenisSampah', 'penukaranPoins'])
            ->where('kode_unik', $kode_unik)
            ->firstOrFail();

        return view('warga.public_show', compact('warga'));
    }
}
