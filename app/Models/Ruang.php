<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruang extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'kode_ruang',
        'nama_ruang',
        'keterangan'
    ];
}
