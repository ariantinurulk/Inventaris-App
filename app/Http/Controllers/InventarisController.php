<?php

namespace App\Http\Controllers;

use App\Models\Inventaris;
use App\Models\Jenis;
use App\Models\Ruang;
use Illuminate\Http\Request;
use Auth;

class InventarisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->search;
        
        $inventaris = Inventaris::join('jenis','jenis.id','inventaris.jenis_id')
            ->join('ruangs','ruangs.id','inventaris.ruang_id')
            ->join('petugas','petugas.id','inventaris.petugas_id')
            ->when($search, function ($query, $search) {
                return $query->where('kode_inventaris','like', "%{$search}%")
                ->orWhere('nama_inventaris', 'like', "%{$search}%");
            })
            ->select(
                'inventaris.id as id',
                'inventaris.keterangan as keterangan',
                'kode_inventaris',
                'nama_inventaris',
                'nama_jenis',
                'nama_ruang',
                'nama_petugas',
                'tanggal_register',
                'kondisi',
                'jumlah'
            )
            ->paginate();

        $inventaris->map(function ($row) {
            $row->tanggal_register = date('d/m/Y', strtotime($row->tanggal_register));
            return $row;
        });

        if ($search) {
            $inventaris->appends(['search' => $search]);
        }

        return view('inventaris.index',[
            'inventaris' => $inventaris
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jenis = Jenis::select('id as value','nama_jenis as option')->get();
        $ruang = Ruang::select('id as value','nama_ruang as option')->get();

        return view('inventaris.create', [
            'jenis' => $jenis,
            'ruang' => $ruang
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_inventaris' => 'required|max:10|alpha_num|unique:inventaris',
            'nama_inventaris' => 'required|max:255',
            'keterangan' => 'nullable|max:255',
            'jenis_id' => 'required',
            'ruang_id' => 'required',
            'jumlah' => 'required|numeric',
            'kondisi' => 'required|max:255',
            'tanggal_register' => 'required|date_format:Y-m-d',
        ], [], [
            'jenis_id' => 'Jenis',
            'ruang_id' => 'Ruang'
        ]);

        $request->merge([
            'petugas_id' =>Auth::guard('admin')->id(),
            'kode_inventaris'=>strtoupper(strtolower($request->kode_inventaris))
        ]);

        Inventaris::create($request->all());

        return redirect()->route('inventaris.index')
            ->with('message', 'success store');
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Inventaris  $inventaris
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Inventaris  $inventaris
     * @return \Illuminate\Http\Response
     */
    public function edit(Inventaris $inventari)
    {
        $jenis = Jenis::select('id as value','nama_jenis as option')->get();
        $ruang = Ruang::select('id as value','nama_ruang as option')->get();

        return view('inventaris.edit', [
            'inventaris' => $inventari,
            'jenis' => $jenis,
            'ruang' => $ruang
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Inventaris  $inventaris
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inventaris $inventari)
    {
        $request->validate([
            'kode_inventaris' => 'required|max:10|alpha_num|unique:inventaris,kode_inventaris,' .$inventari->id,
            'nama_inventaris' => 'required|max:255',
            'keterangan' => 'nullable|max:255',
            'jenis_id' => 'required',
            'ruang_id' => 'required',
            'jumlah' => 'required|numeric',
            'kondisi' => 'required|max:255',
            'tanggal_register' => 'required|date_format:Y-m-d',
          ], [], [
            'jenis_id' => 'Jenis',
            'ruang_id' => 'Ruang'
          ]);
    
          $request->merge([
            'kode_inventaris' => strtoupper(strtolower($request->kode_inventaris))
          ]);
    
          $inventari->update($request->all() );
    
          return redirect()->route('inventaris.index')
            ->with('message', 'success update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Inventaris  $inventaris
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inventaris $inventari)
    {
        $inventari->delete();

        return back()->with('message','success delete');
    }
}
