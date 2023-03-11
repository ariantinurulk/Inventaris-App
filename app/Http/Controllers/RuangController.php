<?php

namespace App\Http\Controllers;

use App\Models\Ruang;
use Illuminate\Http\Request;

class RuangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->search;
        
        $ruangs = Ruang::when($search, function ($query, $search) {
                return $query->where('kode_ruang','like', "%{$search}%")
                ->orWhere('nama_ruang', 'like', "%{$search}%");
            })
            ->paginate();

        if ($search) {
            $ruangs->appends(['search' => $search]);
        }

        return view('ruang.index',[
            'ruangs' => $ruangs
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ruang.create');
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
            'kode_ruang' => 'required|max:10|alpha_num|unique:ruangs',
            'nama_ruang' => 'required|max:255',
            'keterangan' => 'nullable|max:255'
        ]);

        $request->merge([
            'kode_ruang'=>strtoupper(strtoupper($request->kode_ruang))
        ]);

        Ruang::create($request->all());

        return redirect()->route('ruang.index')
            ->with('message', 'success store');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ruang  $ruang
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ruang  $ruang
     * @return \Illuminate\Http\Response
     */
    public function edit(Ruang $ruang)
    {
        return view('ruang.edit',[
            'ruang'=> $ruang
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ruang  $ruang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ruang $ruang)
    {
        $request->validate([
            'kode_ruang' => 'required|max:10|alpha_num|unique:ruangs',
            'nama_ruang' => 'required|max:255',
            'keterangan' => 'nullable|max:255'
        ]);

        
        $request->merge([
            'kode_ruang'=>strtoupper(strtolower($request->kode_ruang))
        ]);

        $ruang->update($request->all() );

        return redirect()->route('ruang.index')
        ->with('message', 'success update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ruang  $ruang
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ruang $ruang)
    {
        $ruang->delete();

        return back()->with('message','success delete');
    }
}
