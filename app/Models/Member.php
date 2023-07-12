<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function users()
    {
        return $this->belongsTo(Users::class);
    }

    public function detail__obats()
    {
        return $this->hasMany(Detail_Obat::class);
    }

    public function pembelians()
    {
        return $this->hasMany(Pembelian::class);
    }
}
