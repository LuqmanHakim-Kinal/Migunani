<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keluhan extends Model
{
    protected $fillable = [
        'judul', 
        'penyewa_id', 
        'tanggal_pelaporan', 
        'status', 
        'tanggal_selesai', 
        'keterangan'
    ];

    public function penyewa()
    {
        return $this->belongsTo(Penyewa::class);
    }
}
