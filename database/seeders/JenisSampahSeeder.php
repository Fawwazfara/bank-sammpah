<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JenisSampah;

class JenisSampahSeeder extends Seeder
{
    public function run(): void
    {
        JenisSampah::insert([
            ['nama_jenis' => 'Plastik (Botol/Gelas)', 'poin_per_kg' => 1500],
            ['nama_jenis' => 'Kertas & Kardus', 'poin_per_kg' => 1000],
            ['nama_jenis' => 'Besi & Logam', 'poin_per_kg' => 3000],
            ['nama_jenis' => 'Botol Kaca', 'poin_per_kg' => 500],
            ['nama_jenis' => 'Minyak Jelantah', 'poin_per_kg' => 2500],
        ]);
    }
}
