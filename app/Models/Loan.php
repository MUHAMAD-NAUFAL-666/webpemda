<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    protected $table = 'loans'; // Pastikan nama tabel sesuai

    protected $fillable = [
        'user_id',
        'book_id',
        'status',
        // kolom lain sesuai kebutuhan
    ];
}
