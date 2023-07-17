<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        return view('sign-in');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'notelp' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            // return redirect()->intended('/');
            if(Auth::user()->role == 'admin'){
                return redirect()->intended('/admin');

            // dd(Auth::user()->role);
            }
            if(Auth::user()->role == 'manajemen'){
                return redirect()->intended('/manajemen');
            }
            else{
                return redirect()->intended('/pegawai');
            }
        }

        return back()->with('alert', 'Gagal masuk ke akun Anda, silakan coba lagi!');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect()->intended('/');
    }
}
