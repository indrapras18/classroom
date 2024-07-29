<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        $totalKelas = DB::table('kelas')->count();
        $totalMateri = DB::table('materis')->count();
        $totalSiswa = DB::table('users')->where('role', 'Siswa')->count();
        return view('admin', compact('totalKelas', 'totalSiswa', 'totalMateri'));
    }

    public function users(){
        $totalMateri = DB::table('materis')->count();
        return view('user', compact('totalMateri'));
    }
}
