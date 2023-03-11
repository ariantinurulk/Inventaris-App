<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class ProfileAdminController extends Controller
{
    public function profile()
    {
        $petugas = Auth::guard('admin')->user();
        return view('profile.profile-petugas',[
            'petugas'=>$petugas
            ]);
    }

    public function update(Request $request)
    {
        $petugas = Auth::guard('admin')->user();
        $request->validate([
            'nama_petugas'=> 'required|between:3, 255',
            'username'=> 'required|between:3, 255|unique:petugas,username,'.$petugas->id,
            'password'=> 'nullable|between:4, 255|confirmed',
            ],[],[
                'nama_petugas'=>'Nama'
            ]);

            if ($request->password) {
                $request->merge([
                    'password'=>bcrypt($request->password),
                ]);
                $petugas->update($request->all());
            } else {
                $petugas->update($request->except('password'));
            }
            return back()->with('message','success update');
    }

}
