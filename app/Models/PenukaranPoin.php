<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['warga_id', 'jumlah_poin', 'keterangan', 'petugas_id'])]
class PenukaranPoin extends Model
{
    public function warga()
    {
        return $this->belongsTo(Warga::class);
    }

    public function petugas()
    {
        return $this->belongsTo(User::class, 'petugas_id');
    }
}
