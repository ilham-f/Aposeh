<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail_Obat extends Model
{
    use HasFactory;

    protected $table = 'detail__obats';

    public function members()
    {
        return $this->belongsTo(Member::class);
    }
}
