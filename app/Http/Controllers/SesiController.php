<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SesiController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ], [
            'email.required' => 'email wajib diisi',
            'password.required' => 'password wajib diisi'
        ]);

        $infologin = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if(Auth::attempt($infologin)){
            if (Auth::user()->role == 'Guru') {
                return redirect('admin');
            }elseif(Auth::user()->role == 'Siswa'){
                return redirect('user');
            }
        }else{
            return redirect('')->withErrors('Username dan password tidak sesuai')->withInput();
        }
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}
