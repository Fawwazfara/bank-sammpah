<?php

namespace App\Http\Controllers;

use App\Models\Setoran;
use App\Models\Warga;
use App\Models\JenisSampah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index()
    {
        $totalSampahPerJenis = Setoran::join('jenis_sampahs', 'setorans.jenis_sampah_id', '=', 'jenis_sampahs.id')
            ->select('jenis_sampahs.nama_jenis', DB::raw('SUM(setorans.berat_kg) as total_berat'))
            ->groupBy('jenis_sampahs.nama_jenis')
            ->get();

        $rankingWarga = Warga::orderByDesc('poin_total')->take(10)->get();

        return view('laporan.index', compact('totalSampahPerJenis', 'rankingWarga'));
    }
}
