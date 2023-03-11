<?php

namespace App\Http\Controllers;

use App\Models\Inventaris;
use App\Models\Pegawai;
use App\Models\Peminjaman;
use DB;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function petugas()
    {
        $peminjaman = Peminjaman::where('status_peminjaman','pinjam')
        ->select(
            DB::raw("count(*) as jumlah ")
        )->first();

        $inventaris = Inventaris::select(
            DB::raw("sum(jumlah) as total")
        )->first();

        $pegawai = Pegawai::select(
            DB::raw("count(*) as jumlah")
        )->first();

        return view('dashboard.admin', [
            'peminjaman' => $peminjaman,
            'inventaris' => $inventaris,
            'pegawai' => $pegawai
        ]);
    }

    public function pegawai()
    {
        $peminjaman = Peminjaman::where('status_peminjaman','pinjam')
        ->where('pegawai_id',auth()->id() )
        ->select(
            DB::raw("count(*) as jumlah")
        )->first();

        return view('dashboard.pegawai', [
            'peminjaman' => $peminjaman,
        ]);
    }
}
