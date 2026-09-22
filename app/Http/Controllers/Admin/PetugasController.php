<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class PetugasController extends Controller
{
    public function index()
    {
        $petugas = User::where('role', 'petugas')->latest()->paginate(10);
        return view('admin.petugas.index', compact('petugas'));
    }

    public function create()
    {
        return view('admin.petugas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'petugas',
        ]);

        return redirect()->route('admin.petugas.index')->with('success', 'Akun Petugas berhasil ditambahkan.');
    }

    public function edit(User $petuga) // route model binding matches parameter name usually singular of resource, so $petuga or $petugas. The route is 'petugas' so parameter is $petuga. Let's use $user internally.
    {
        return view('admin.petugas.edit', ['petugas' => $petuga]);
    }

    public function update(Request $request, User $petuga)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class.',id,'.$petuga->id],
        ]);

        $petuga->name = $request->name;
        $petuga->email = $request->email;

        if ($request->filled('password')) {
            $request->validate([
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);
            $petuga->password = Hash::make($request->password);
        }

        $petuga->save();

        return redirect()->route('admin.petugas.index')->with('success', 'Data Petugas berhasil diperbarui.');
    }

    public function destroy(User $petuga)
    {
        $petuga->delete();
        return redirect()->route('admin.petugas.index')->with('success', 'Akun Petugas berhasil dihapus.');
    }
}
