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

class PeminjamanAdminController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $pegawais = Pegawai::all();
        
        $peminjamans = Peminjaman::join('pegawais','pegawais.id','peminjamans.pegawai_id')
            ->when($search, function ($query, $search) {
                return $query->where('nama_pegawai','like', "%{$search}%");
            })
            ->select(
                'peminjamans.id as id',
                'nama_pegawai',
                'tanggal_pinjam',
                'tanggal_kembali',
                'status_peminjaman'
            )
            ->orderBy('peminjamans.id','desc')
            ->paginate();

        $peminjamans->map(function ($row) {
            $row->tanggal_pinjam = date('d/m/Y', strtotime($row->tanggal_pinjam));
            $row->tanggal_kembali = date('d/m/Y', strtotime($row->tanggal_kembali));
        });

        if ($search) {
            $peminjamans->appends(['search' => $search]);
        }

        return view('peminjaman.admin.index',[
            'peminjamans' => $peminjamans,
            'pegawais' => $pegawais,
        ]);
    }

    public function create(Pegawai $pegawai)
    {
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

        return view('peminjaman.admin.create', [
            'pegawai' => $pegawai,
            'inventaris' => $inventaris,
            'items' => $items
        ]);
    }

    public function add(Pegawai $pegawai, Inventaris $inventari)
    {
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

    public function update(Request $request, Pegawai $pegawai, Inventaris $inventari)
    {
        $type = $request->type;
        Cart::session($pegawai->id)->update($inventari->id, [
            'quantity' => $type == 'min' ? -1 : 1,
        ]);

        return back();
    }

    public function delete(Pegawai $pegawai, Inventaris $inventari)
    {
        Cart::session($pegawai->id)->remove($inventari->id);
        return back();
    }

    public function empty(Pegawai $pegawai)
    {
        Cart::session($pegawai->id)->clear();
        return back();
    }

    public function store(Request $request, Pegawai $pegawai)
    {
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

        return redirect()->route('admin.peminjaman.info',['peminjaman'=>$peminjaman->id]);
    }

    public function info(Peminjaman $peminjaman)
    {
        $pegawai = Pegawai::find($peminjaman->pegawai_id);

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

        return view('peminjaman.admin.info', [
            'pegawai' => $pegawai,
            'peminjaman' => $peminjaman,
            'details' => $details
        ]);
    }

    public function card(Peminjaman $peminjaman)
    {
        $pegawai = Pegawai::find($peminjaman->pegawai_id);

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

        return view('peminjaman.admin.card', [
            'pegawai' => $pegawai,
            'peminjaman' => $peminjaman,
            'details' => $details
        ]);
}

    public function status(Peminjaman $peminjaman, $status)
    {
        if( $status != 'batal' && $status != 'selesai') {
            return abort(404);
        }

        $peminjaman->update([
            'status_peminjaman'=>$status
        ]);

        return back();
    }

}
