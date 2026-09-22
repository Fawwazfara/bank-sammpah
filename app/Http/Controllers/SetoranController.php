<?php

namespace App\Http\Controllers;

use App\Models\Setoran;
use App\Models\Warga;
use App\Models\JenisSampah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SetoranController extends Controller
{
    public function index()
    {
        $setorans = Setoran::with(['warga', 'jenisSampah', 'petugas'])->latest()->paginate(15);
        return view('setoran.index', compact('setorans'));
    }

    public function create()
    {
        $jenisSampahs = JenisSampah::all();
        // Warga list is retrieved dynamically or via JS, but we can pass all if small
        $wargas = Warga::with('user')->get();
        return view('setoran.create', compact('jenisSampahs', 'wargas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'warga_id' => 'required|exists:wargas,id',
            'jenis_sampah_id' => 'required|exists:jenis_sampahs,id',
            'berat_kg' => 'required|numeric|min:0.01',
        ]);

        $jenisSampah = JenisSampah::findOrFail($validated['jenis_sampah_id']);
        $poinDidapat = intval($validated['berat_kg'] * $jenisSampah->poin_per_kg);

        DB::transaction(function () use ($validated, $poinDidapat) {
            Setoran::create([
                'warga_id' => $validated['warga_id'],
                'jenis_sampah_id' => $validated['jenis_sampah_id'],
                'berat_kg' => $validated['berat_kg'],
                'poin_didapat' => $poinDidapat,
                'petugas_id' => Auth::id(),
            ]);

            $warga = Warga::findOrFail($validated['warga_id']);
            $warga->increment('poin_total', $poinDidapat);
        });

        return redirect()->route('setoran.index')->with('success', 'Setoran berhasil disimpan. Poin warga bertambah ' . $poinDidapat);
    }
}
