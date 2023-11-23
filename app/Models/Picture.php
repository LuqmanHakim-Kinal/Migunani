<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    use HasFactory;
    protected $fillable = ['penyewa_id', 'kamar_id', 'inventory_id', 'filename'];
    
    public function kamar()
    {
        return $this->belongsTo(Kamar::class);
    }
    public function inventory()
    {
        return $this->belongsTo(Inventory::class);
    }
    public function calonpenyewa()
    {
        return $this->belongsTo(CalonPenyewa::class);
    }
}
