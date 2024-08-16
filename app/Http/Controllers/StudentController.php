<?php

namespace App\Http\Controllers;

use App\Models\Answers;
use App\Models\Assignments;
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
    function users(){
        $totalTugas = DB::table('assignments')->count();
        $totalMateri = DB::table('materis')->count();
        return view('user', compact('totalMateri', 'totalTugas'));
    }

    function hasilPembelajaran(){
        $userId = Auth::id();
        $studentScores = StudentScores::with('assignment')
            ->where('id_user', $userId)
            ->get();
    
        return view('pages/student/hasilPembelajaran', compact('studentScores'));
    }

    public function detailTugas($id){
    $assignment = Assignments::with('questions')->find($id);
    $userAnswers = Results::where('id_user', auth()->id())
                        ->whereIn('id_question', $assignment->questions->pluck('id'))
                        ->get()
                        ->keyBy('id_question');
    return view('pages.student.detailTugas', compact('assignment', 'userAnswers'));
}


    function siswa(){
        $siswa = DB::table('users')
            ->join('kelas', 'users.id_kelas', '=', 'kelas.id')
            ->select('users.id', 'users.name', 'users.email', 'users.password', 'users.role', 'users.id_kelas', 'kelas.nama_kelas') // Tambahkan 'users.id_kelas'
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

    function updateSiswa($id, Request $request) {
        $data = User::find($id);
    
        if ($request->filled('password')) {
            $data->password = Hash::make($request->password);
        }
    
        $data->name = $request->name;
        $data->email = $request->email;
        $data->id_kelas = $request->id_kelas;
    
        $data->save();
    
        return redirect()->route('siswa')->with('success', 'Data Siswa Berhasil di Perbarui!');
    }

    function deleteSiswa($id){
        $data = User::find($id);
        $data->delete();
        return redirect()->route('siswa')->with('success', 'Data Siswa Berhasil di Hapus!');
    }
}
