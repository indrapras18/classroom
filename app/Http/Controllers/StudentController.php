<?php

namespace App\Http\Controllers;

use App\Models\Answers;
use App\Models\Kelas;
use App\Models\Materis;
use App\Models\Questions;
use App\Models\Results;
use App\Models\StudentScores;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class StudentController extends Controller
{


    public function users(){
        $totalMateri = DB::table('materis')->count();
        return view('user', compact('totalMateri'));
    }

    function siswa(){
        $siswa = DB::table('users')
        ->join('kelas', 'users.id_kelas', '=', 'kelas.id')
        ->select('users.id', 'users.name', 'users.email', 'users.role', 'kelas.nama_kelas')
        ->where('users.role', 'Siswa')
        ->get();
        $semuaKelas = Kelas::all();
        return view('pages/teacher/siswa', compact('siswa', 'semuaKelas'));
    }

    function tambahSiswa(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'id_kelas' => 'required|exists:kelas,id',
        ]);
        $validatedData['password'] = Hash::make($validatedData['password']);
        User::create($validatedData);
        return redirect()->route('siswa')->with('success', 'Data Siswa Berhasil Ditambahkan!');
    }

    function tampildataSiswa($id){
        $data = User::find($id);
        $kelas = Kelas::all();
        return view('pages/teacher/tampildataSiswa', compact('data','kelas'));
    }

    function updateSiswa($id, Request $request){
        $data = User::find($id);
        $data->update($request->all());
        return redirect()->route('siswa');
    }

    function deleteSiswa($id){
        $data = User::find($id);
        $data->delete();
        return redirect()->route('siswa');
    }
}
