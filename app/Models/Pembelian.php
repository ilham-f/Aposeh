<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function obats()
    {
        return $this->belongsToMany(Obat::class, 'detail__obats')->withPivot('jml_obat','subtotal','dosis_hari','dosis_obat','estimasi_habis');
    }

    public function members()
    {
        return $this->belongsTo(Member::class);
    }
}
