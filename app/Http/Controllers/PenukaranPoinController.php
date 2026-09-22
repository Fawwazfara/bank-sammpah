<?php

namespace App\Http\Controllers;

use App\Models\PenukaranPoin;
use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PenukaranPoinController extends Controller
{
    public function index()
    {
        $penukarans = PenukaranPoin::with(['warga', 'petugas'])->latest()->paginate(15);
        return view('penukaran_poin.index', compact('penukarans'));
    }

    public function create()
    {
        $wargas = Warga::with('user')->get();
        return view('penukaran_poin.create', compact('wargas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'warga_id' => 'required|exists:wargas,id',
            'jumlah_poin' => 'required|integer|min:1',
            'keterangan' => 'required|string|max:255',
        ]);

        $warga = Warga::findOrFail($validated['warga_id']);

        if ($warga->poin_total < $validated['jumlah_poin']) {
            return back()->withInput()->withErrors(['jumlah_poin' => 'Poin tidak cukup. Poin maksimal: ' . $warga->poin_total]);
        }

        DB::transaction(function () use ($validated, $warga) {
            PenukaranPoin::create([
                'warga_id' => $validated['warga_id'],
                'jumlah_poin' => $validated['jumlah_poin'],
                'keterangan' => $validated['keterangan'],
                'petugas_id' => Auth::id(),
            ]);

            $warga->decrement('poin_total', $validated['jumlah_poin']);
        });

        return redirect()->route('penukaran-poin.index')->with('success', 'Penukaran poin berhasil. Sisa poin warga: ' . $warga->fresh()->poin_total);
    }
}
