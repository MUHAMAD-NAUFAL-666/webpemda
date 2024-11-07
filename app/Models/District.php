<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    protected $table = 'reg_districts';

    protected $fillable = [
        'regency_id', // ID Kabupaten
        'name',       // Nama Kecamatan
    ];

    public function villages()
    {
        return $this->hasMany(Village::class, 'district_id');
    }

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'district_id');
    }

    public function regency()
    {
        return $this->belongsTo(Regency::class, 'regency_id');
    }
}
