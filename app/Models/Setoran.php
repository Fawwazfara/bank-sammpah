<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['warga_id', 'jenis_sampah_id', 'berat_kg', 'poin_didapat', 'petugas_id'])]
class Setoran extends Model
{
    public function warga()
    {
        return $this->belongsTo(Warga::class);
    }

    public function jenisSampah()
    {
        return $this->belongsTo(JenisSampah::class);
    }

    public function petugas()
    {
        return $this->belongsTo(User::class, 'petugas_id');
    }
}
