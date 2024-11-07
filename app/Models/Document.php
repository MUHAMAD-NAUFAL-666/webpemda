<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'dokumen_dipinjam',
        'jenis_no_hak_di_208',
        'desa_kelurahan',
        'kecamatan',
        'peminjam',
        'keperluan',
        'tanggal',
    ];
}
