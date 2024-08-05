<?php

namespace App\Http\Controllers;

use App\Models\Assignments;
use App\Models\Questions;
use Illuminate\Http\Request;

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

        return redirect()->route('penugasan');
    }

    function detailTugasEssay($id){
        $tugasEssay = Assignments::findOrFail($id);
        $soal = Questions::where('id_assignment', $id)->get();
        return view('pages/teacher/detailTugasEssay',compact('tugasEssay', 'soal'));
    }

    function detailTugasPilihan($id){
        $tugasPilihan = Assignments::findOrFail($id);
        $soal = Questions::where('id_assignment', $id)->get();
        return view('pages/teacher/detailTugasPilihan',compact('tugasPilihan','soal'));
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
        return redirect()->route('penugasan');
    }

    function deleteAssignment($id){
        $data = Assignments::find($id);
        $data->delete();
        return redirect()->route('penugasan');
    }
}
