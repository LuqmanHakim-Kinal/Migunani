<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomor_kamar',
        'status_kamar',
        'harga_kamar',
    ];

    public function penyewa()
    {
        return $this->belongsTo(Penyewa::class);
    }

    public function pictures()
    {
        return $this->hasMany(Picture::class);
    }
    public function getStatusAttribute()
    {
        return $this->penyewa ? 'Terisi' : 'Belum Terisi';
    }
}
