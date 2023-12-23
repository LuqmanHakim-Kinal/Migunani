<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Penyewa extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    public function pictures()
    {
        return $this->hasMany(Picture::class);
    }
    public function kamars()
    {
    return $this->hasMany(Kamar::class);
    }
    public function tambahBulanHabisSewa($jumlahBulan)
    {
        // Tambahkan bulan ke tanggal_habis_sewa
        $this->tanggal_selesai = Carbon::parse($this->tanggal_selesai)->addMonths($jumlahBulan);
        $this->save();
    }
}
