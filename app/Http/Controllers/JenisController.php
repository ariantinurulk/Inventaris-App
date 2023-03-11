<?php

namespace App\Http\Controllers;

use App\Models\Jenis;
use Illuminate\Http\Request;

class JenisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->search;
        
        $jenis = Jenis::when($search, function ($query, $search) {
                return $query->where('kode_jenis','like', "%{$search}%")
                ->orWhere('nama_jenis', 'like', "%{$search}%");
            })
            ->paginate();

        if ($search) {
            $jenis->appends(['search' => $search]);
        }

        return view('jenis.index',[
            'jenis' => $jenis
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('jenis.create');
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
            'kode_jenis' => 'required|max:10|alpha_num|unique:jenis',
            'nama_jenis' => 'required|max:255',
            'keterangan' => 'nullable|max:255'
        ]);

        $request->merge([
            'kode_jenis'=>strtoupper(strtoupper($request->kode_jenis))
        ]);

        Jenis::create($request->all());

        return redirect()->route('jenis.index')
            ->with('message', 'success store');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Jenis  $jenis
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Jenis  $jenis
     * @return \Illuminate\Http\Response
     */
    public function edit(Jenis $jeni)
    {
        return view('jenis.edit',[
            'jenis'=> $jeni
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Jenis  $jenis
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jenis $jeni)
    {
        $request->validate([
            'kode_jenis' => 'required|max:10|alpha_num|unique:jenis',
            'nama_jenis' => 'required|max:255',
            'keterangan' => 'nullable|max:255'
        ]);

        
        $request->merge([
            'kode_jenis'=>strtoupper(strtolower($request->kode_jenis))
        ]);

        $jeni->update($request->all() );

        return redirect()->route('jenis.index')
        ->with('message', 'success update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Jenis  $jenis
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jenis $jeni)
    {
        $jeni->delete();

        return back()->with('message','success delete');
    }
}
