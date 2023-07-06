<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function pembelians()
    {
        return $this->belongsToMany(Pembelian::class, 'detail__obats')->withPivot('estimasi_habis','harga');
    }
}
