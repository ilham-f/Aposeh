<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    use HasFactory;

    public function obats()
    {
        return $this->belongsToMany(Obat::class, 'detail_obat')->withPivot('estimasi_habis','harga');
    }

    public function members()
    {
        return $this->belongsTo(Member::class);
    }
}
