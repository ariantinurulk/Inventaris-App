<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class ProfileController extends Controller
{
    public function profile()
    {
        $pegawai = Auth::user();
        return view('profile.profile',[
            'pegawai'=>$pegawai
            ]);
    }

    public function update(Request $request)
    {
        $pegawai = Auth::user();
        $request->validate([
            'nama_pegawai'=> 'required|between:3, 255',
            'username'=> 'required|between:3, 255|unique:pegawais,username,'.$pegawai->id,
            'password'=> 'nullable|between:4, 255|confirmed',
            'alamat'=>'required|between:10, 500',
            'nip'=>'nullable|between:18, 255'
            ],[],[
                'nama_pegawai'=>'Nama'
            ]);

            if ($request->password) {
                $request->merge([
                    'password'=>bcrypt($request->password),
                ]);
                $pegawai->update($request->all());
            } else {
                $pegawai->update($request->except('password'));
            }
            return back()->with('message','success update');
    }
}
