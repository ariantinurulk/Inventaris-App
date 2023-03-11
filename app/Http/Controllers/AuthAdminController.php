<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class AuthAdminController extends Controller
{
    public function __construct ()
    {
        $this->middleware('guest:admin',['except'=>'logout']);
    }

    public function formLogin()
    {
        return view('auth.login-admin');
    }

    public function login (Request $request)
    {
        $cred = $request->validate ([
            'username'=>'required|exists:petugas',
            'password'=>'required'
        ]);

        if (Auth::guard('admin')->attempt ($cred, $request->remember)) {
            $request->session()->regenerate();
            return redirect()->intended('admin');
        }

        return back()->withErrors([
            'username'=>'The provided credentials do not match our records.',
        ]);
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }


}
