<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventaris extends Model
{
    use HasFactory;

    protected $fillable = [
        'jenis_id',
        'ruang_id',
        'petugas_id',
        'kode_inventaris',
        'nama_inventaris',
        'kondisi',
        'jumlah',
        'tanggal_register',
        'keterangan'
    ];
}
