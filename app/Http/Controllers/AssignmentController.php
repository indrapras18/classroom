<?php

namespace App\Http\Controllers;

use App\Models\Assignments;
use App\Models\Questions;
use App\Models\StudentScores;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AssignmentController extends Controller
{
    function showPenugasan(){
        $data = Assignments::all();
        return view('pages/teacher/penugasan',compact('data'));
    }

    function tampildataPenugasan($id){
        $items = Assignments::find($id);
        return view('pages/teacher/tampildataPenugasan',compact('items'));
    }

    function tambahTugas(){
        return view('pages/teacher/tambahTugas');
    }

    function submitTugas(Request $request){
        $request->validate([
            'judul_tugas' => 'required|string|max:255',
            'tipe' => 'required|in:pilihan,essay',
            'deskripsi_tugas' => 'required|string',
        ]);

        Assignments::create([
            'judul_tugas' => $request->input('judul_tugas'),
            'tipe' => $request->input('tipe'),
            'deskripsi_tugas' => $request->input('deskripsi_tugas'),
        ]);

        return redirect()->route('penugasan')->with('success', 'Tugas Berhasil Ditambahkan!');
    }

    function detailTugasEssay($id){
        $tugasEssay = Assignments::findOrFail($id);
        $soal = Questions::where('id_assignment', $id)->get();
        $jumlahSoal = $soal->count();
        return view('pages/teacher/detailTugasEssay',compact('tugasEssay', 'soal', 'jumlahSoal'));
    }

    function detailTugasPilihan($id){
        $tugasPilihan = Assignments::findOrFail($id);
        $soal = Questions::where('id_assignment', $id)->get();
        $jumlahSoal = $soal->count();
        return view('pages/teacher/detailTugasPilihan',compact('tugasPilihan','soal', 'jumlahSoal'));
    }
    function tambahSoal($id) {
        $assignment = Assignments::findOrFail($id);
        return view('pages/teacher/tambahSoal', compact('assignment'));
    }

    function essay($id){
        $assignment = Assignments::findOrFail($id);
        return view('pages/teacher/essay', compact('assignment'));
    }

    function updatePenugasan(Request $request, $id){
        $data = Assignments::find($id);
        $data->update($request->all());
        return redirect()->route('penugasan')->with('success', 'Tugas Berhasil Diperbarui!');

    }

    function deleteAssignment($id){
        $data = Assignments::find($id);
        $data->delete();
        return redirect()->route('penugasan')->with('success', 'Tugas Berhasil Dihapus!');

    }

    function deskripsiEssay($id) {
        $tugasEssay = Assignments::findOrFail($id);
        $soal = Questions::where('id_assignment', $id)->get();
        $jumlahSoal = $soal->count();
        return view('pages/student/Essay', compact('tugasEssay', 'soal', 'jumlahSoal'));
    }

    function deskripsiPilihan($id) {
        $tugasPilihan = Assignments::findOrFail($id);
        $soal = Questions::where('id_assignment', $id)->get();
        $jumlahSoal = $soal->count();
        return view('pages/student/PilihanGanda', compact('tugasPilihan', 'soal', 'jumlahSoal'));
    }
    
}