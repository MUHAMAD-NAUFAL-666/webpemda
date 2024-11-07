<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Village extends Model
{
    use HasFactory;

    protected $table = 'reg_villages';

    protected $fillable = [
        'district_id', // ID Kecamatan
        'name',        // Nama Desa
    ];

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'village_id');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id');
    }
}
