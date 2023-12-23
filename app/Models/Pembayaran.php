<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $perPage = 5;
    public function pictures()
    {
        return $this->hasMany(Picture::class);
    }
        public function penyewas()
    {
        return $this->hasMany(Penyewa::class);
    }
}
