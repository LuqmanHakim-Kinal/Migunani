<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
