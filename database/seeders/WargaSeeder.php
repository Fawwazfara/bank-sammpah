<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Warga;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class WargaSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::create([
            'name' => 'Budi Santoso',
            'email' => 'warga@banksampah.com',
            'password' => Hash::make('password'),
            'role' => 'warga',
        ]);

        Warga::create([
            'user_id' => $user->id,
            'no_hp' => '081234567890',
            'alamat' => 'Jl. Desa Coba No. 1',
            'kode_unik' => Str::uuid()->toString(),
            'poin_total' => 0,
        ]);
    }
}
