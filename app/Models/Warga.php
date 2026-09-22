<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Warga extends Model
{
    protected $fillable = [
        'user_id',
        'no_hp',
        'alamat',
        'kode_unik',
        'poin_total',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function setorans()
    {
        return $this->hasMany(Setoran::class);
    }

    public function penukaranPoins()
    {
        return $this->hasMany(PenukaranPoin::class);
    }
}
