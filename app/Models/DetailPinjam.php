<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPinjam extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'peminjaman_id',
        'inventaris_id',
        'jumlah_pinjam'
    ];
}
