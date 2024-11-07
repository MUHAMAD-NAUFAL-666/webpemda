<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Regency extends Model
{
    use HasFactory;

    protected $table = 'reg_regencies';

    protected $fillable = [
        'province_id', // ID Provinsi (jika diperlukan untuk struktur data)
        'name',        // Nama Kabupaten
    ];

    public function districts()
    {
        return $this->hasMany(District::class, 'regency_id');
    }
    
    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'regency_id');
    }
}
