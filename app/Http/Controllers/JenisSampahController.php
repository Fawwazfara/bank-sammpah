<?php

namespace App\Http\Controllers;

use App\Models\JenisSampah;
use Illuminate\Http\Request;

class JenisSampahController extends Controller
{
    public function index()
    {
        $jenisSampahs = JenisSampah::all();
        return view('jenis_sampah.index', compact('jenisSampahs'));
    }

    public function create()
    {
        return view('jenis_sampah.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_jenis' => 'required|string|max:255',
            'poin_per_kg' => 'required|integer|min:0',
        ]);

        JenisSampah::create($validated);

        return redirect()->route('jenis-sampah.index')->with('success', 'Jenis Sampah berhasil ditambahkan.');
    }

    public function edit(JenisSampah $jenisSampah)
    {
        return view('jenis_sampah.edit', compact('jenisSampah'));
    }

    public function update(Request $request, JenisSampah $jenisSampah)
    {
        $validated = $request->validate([
            'nama_jenis' => 'required|string|max:255',
            'poin_per_kg' => 'required|integer|min:0',
        ]);

        $jenisSampah->update($validated);

        return redirect()->route('jenis-sampah.index')->with('success', 'Jenis Sampah berhasil diperbarui.');
    }

    public function destroy(JenisSampah $jenisSampah)
    {
        $jenisSampah->delete();
        return redirect()->route('jenis-sampah.index')->with('success', 'Jenis Sampah berhasil dihapus.');
    }
}
