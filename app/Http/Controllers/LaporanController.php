<?php

namespace App\Http\Controllers;

use App\Models\Inventaris;
use App\Models\Ruang;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        $ruangs = Ruang::select('id as value','nama_ruang as option')
        ->orderBy('nama_ruang')
        ->get();

        return view('laporan.index',[
            'ruangs'=>$ruangs
        ]);
    }

    public function inventaris(Request $request)
    {
        $ruang = Ruang::find($request->ruang_id);

        if(!$ruang){
            return abort(404);
        }

        $inventaris = Inventaris::join('jenis','jenis.id','inventaris.jenis_id')
        ->join('ruangs','ruangs.id','inventaris.ruang_id')
        ->join('petugas','petugas.id','inventaris.petugas_id')
        ->where('ruang_id', $ruang->id)
        ->select(
            'inventaris.id as id',
            'inventaris.keterangan as keterangan',
            'kode_inventaris',
            'nama_inventaris',
            'nama_jenis',
            'nama_petugas',
            'tanggal_register',
            'kondisi',
            'jumlah'
        )
        ->get();

        $inventaris->map(function($row){
            $row->tanggal_register= date('d/m/Y', strtotime($row->tanggal_register));
            return $row;
        });

        return view('laporan.inventaris',[
            'inventaris'=>$inventaris,
            'ruang'=>$ruang,
        ]);
    }
}