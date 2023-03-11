<?php

namespace App\Http\Controllers;

use App\Models\DetailPinjam;
use App\Models\Inventaris;
use App\Models\Jenis;
use App\Models\Pegawai;
use App\Models\Peminjaman;
use App\Models\Ruang;
use Illuminate\Http\Request;
use Cart;
use Auth;

class PeminjamanController extends Controller
{
    public function index()
    {

         $pegawai = Auth::user();

         $peminjamans = Peminjaman::where('pegawai_id',$pegawai->id)
         ->orderBy('id','desc')
         ->paginate();

         $peminjamans->map(function($row){
            $row->tanggal_pinjam = date('d/m/Y', strtotime($row->tanggal_pinjam));
            $row->tanggal_kembali= date('d/m/Y', strtotime($row->tanggal_kembali));
         });

         return view('peminjaman.index',[
            'peminjamans'=>$peminjamans,
         ]);
    }

    public function create()
    {
        $pegawai = Auth::user();

        $inventaris = Inventaris::join('ruangs','ruangs.id','inventaris.ruang_id')
        ->join('jenis','jenis.id','inventaris.jenis_id')
        ->select(
            'inventaris.id as id',
            'nama_inventaris',
            'nama_ruang',
            'nama_jenis',
            )
        ->get();

        $items = Cart::session($pegawai->id)->getContent();

        return view('peminjaman.create', [
            'pegawai' => $pegawai,
            'inventaris' => $inventaris,
            'items' => $items
        ]);

    }

    public function add(Inventaris $inventari)
    {
        $pegawai = Auth::user();

        $jenis = Jenis::find($inventari->jenis_id);
        $ruang = Ruang::find($inventari->ruang_id);

        Cart::session($pegawai->id)->add([
            'id'=>$inventari->id,
            'price'=>0,
            'quantity'=>1,
            'name'=>$inventari->nama_inventaris,
            'attributes'=>[
                'jenis'=> $jenis->nama_jenis,
                'ruang'=> $ruang->nama_ruang
            ]
        ]);

        return back();
    }

    public function update(Request $request, Inventaris $inventari)
    {
        $pegawai = Auth::user();
        $type =$request->type;

        Cart::session($pegawai->id)->update($inventari->id,[
        'quantity'=> $type == 'min' ? -1:1,
    ]);
        return back();
    }

    public function delete(Inventaris $inventari)
    {
        $pegawai = Auth::user();

        Cart::session($pegawai->id)->remove($inventari->id);
        return back();
    }

    public function empty()
    {
        $pegawai = Auth::user();

        Cart::session($pegawai->id)->clear();
        return back();
    }

    public function store(Request $request)
    {
        $pegawai = Auth::user();

        if (Cart::session($pegawai->id)->isEmpty() ) {
            return back()->with('message','fail store');
        }

        $request->validate([
            'tanggal_pinjam'=>'required|date_format:Y-m-d|before:tanggal_kembali',
            'tanggal_kembali'=>'required|date_format:Y-m-d|after:tanggal_pinjam',
        ]);

        $request->merge([
            'pegawai_id'=>$pegawai->id,
        ]);

        $peminjaman = Peminjaman::create($request->all());

        $items = Cart::session($pegawai->id)->getContent();

        foreach($items as $item) {
            DetailPinjam::create([
                'peminjaman_id'=>$peminjaman->id,
                'inventaris_id'=>$item->id,
                'jumlah_pinjam'=>$item->quantity,
            ]);
        }

        $this->empty($pegawai);

        return redirect()->route('peminjaman.info',['peminjaman'=>$peminjaman->id]);

    }

    public function info(Peminjaman $peminjaman)
    {
        $pegawai = Auth::user();

        if($peminjaman->pegawai_id !=$pegawai->id){
            return abort(404);

        }
        $details = DetailPinjam::where('peminjaman_id',$peminjaman->id)
        ->join('inventaris','inventaris.id','detail_pinjams.inventaris_id')
        ->join('jenis','jenis.id','inventaris.jenis_id')
        ->join('ruangs','ruangs.id','inventaris.ruang_id')
        ->select(
            'nama_inventaris',
            'nama_ruang',
            'nama_jenis',
            'jumlah_pinjam'
            )
        ->get();

        $peminjaman->tanggal_pinjam = date('d F Y', strtotime($peminjaman->tanggal_pinjam));
        $peminjaman->tanggal_kembali = date('d F Y', strtotime($peminjaman->tanggal_kembali));

        return view('peminjaman.info', [
            'pegawai' => $pegawai,
            'peminjaman' => $peminjaman,
            'details' => $details
        ]);
    }
    
    public function card(Peminjaman $peminjaman)
    {
        $pegawai = Auth::user();

        if($peminjaman->pegawai_id !=$pegawai->id){
            return abort(404);

        }

        $details = DetailPinjam::where('peminjaman_id',$peminjaman->id)
        ->join('inventaris','inventaris.id','detail_pinjams.inventaris_id')
        ->join('jenis','jenis.id','inventaris.jenis_id')
        ->join('ruangs','ruangs.id','inventaris.ruang_id')
        ->select(
            'nama_inventaris',
            'nama_ruang',
            'nama_jenis',
            'jumlah_pinjam'
        )
        ->get();
        $peminjaman->tanggal_pinjam = date('d F Y', strtotime($peminjaman->tanggal_pinjam));
        $peminjaman->tanggal_kembali = date('d F Y', strtotime($peminjaman->tanggal_kembali));

        return view('peminjaman.card', [
            'pegawai' => $pegawai,
            'peminjaman' => $peminjaman,
            'details' => $details
        ]);
    }
}