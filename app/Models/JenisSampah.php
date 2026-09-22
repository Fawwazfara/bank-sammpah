<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['nama_jenis', 'poin_per_kg'])]
class JenisSampah extends Model
{
    public function setorans()
    {
        return $this->hasMany(Setoran::class);
    }
}
