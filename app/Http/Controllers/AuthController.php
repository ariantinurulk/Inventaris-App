<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class AuthController extends Controller 
{
    public function __construct ()
    {
        $this->middleware('guest',['except'=>'logout']);
    }

    public function formLogin()
    {
        return view('auth.login');
    }

    public function login (Request $request)
    {
        $cred = $request->validate([
            'username'=>'required|exists:pegawais',
            'password'=>'required'
        ]);

        if (Auth::attempt ($cred, $request->remember)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'username'=>'The provided credentials do not match our records.',
        ]);
    }

    public function logout ()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
