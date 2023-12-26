<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pembayaran extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $perPage = 5;
    public function penyewa()
    {
        return $this->belongsTo(Penyewa::class, 'penyewa_id');
    }
    public function pictures()
    {
        return $this->hasMany(Picture::class);
    }
        public function penyewas()
    {
        return $this->hasMany(Penyewa::class);
    }
    public static function getMonthlySum()
    {
        return self::select(DB::raw("DATE_FORMAT(created_at, '%c-%Y') as month"), DB::raw("SUM(harga) as value"))
            ->groupBy(DB::raw("DATE_FORMAT(created_at, '%c-%Y')"))
            ->get();
    }
}
