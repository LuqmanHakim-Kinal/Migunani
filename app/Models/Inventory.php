<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'tanggal_pembelian', 
        'nomor_kamar', 
        'kondisi'
    ];

    public function pictures()
    {
        return $this->hasMany(Picture::class);
    }
    public function kamar()
    {
        return $this->belongsTo(Kamar::class);
    }
}