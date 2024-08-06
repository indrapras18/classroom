<?php

namespace App\Http\Controllers;

use App\Models\Questions;
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
        $totalhasil = DB::table('student_scores')->count();
        return view('admin', compact('totalKelas', 'totalSiswa', 'totalMateri', 'totalhasil'));
    }
}
