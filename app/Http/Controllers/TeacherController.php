<?php

namespace App\Http\Controllers;

use App\Models\Answers;
use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Materi;
use App\Models\Materis;
use App\Models\Questions;
use App\Models\ResultEssay;
use App\Models\User;
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class TeacherController extends Controller{
    function kelas(){
        $semuaKelas = Kelas::all();
        return view('pages/teacher/kelas', compact('semuaKelas'));
    }
    
    function siswa(){
        $siswa = DB::table('users')
        ->join('kelas', 'users.id_kelas', '=', 'kelas.id')
        ->select('users.id', 'users.name', 'users.role', 'kelas.nama_kelas')
        ->where('users.role', 'Siswa')
        ->get();
        $semuaKelas = Kelas::all();
        return view('pages/teacher/siswa', compact('siswa', 'semuaKelas'));
    }

    function tambahKelas(Request $request){
        Kelas::create($request->all());
        return redirect()->route('kelas')->with('success', 'Data Kelas Berhasil Ditambahkan!');
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

    function tampildata($id){
        $data = Kelas::find($id);
        return view('pages/teacher/tampildata', compact('data'));
    }

    function updateKelas($id, Request $request){
        $data = Kelas::find($id);
        $data->update($request->all());
        return redirect()->route('kelas');
    }

    function deleteKelas($id){
        $data = Kelas::find($id);
        $data->delete();
        return redirect()->route('kelas');
    }

    function tampildataSIswa($id){
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

    function materi(){
        $materi = Materis::all();
        return view('pages/teacher/materi', compact('materi'));
    }

    function formMateri(){
        return view('pages/teacher/uploadMateri');
    }

    function tambahMateri(Request $request){
        Materis::create($request->all());
        return redirect()->route('materi');
    }

    function deleteMateri($id){
        $data = Materis::find($id);
        $data->delete();
        return redirect()->route('materi');
    }

    function tampildataMateri($id){
        $data = Materis::find($id);
        return view('pages/teacher/tampildataMateri', compact('data'));
    }

    function detailMateri($id){
        $data = Materis::find($id);
        return view('pages/teacher/detailMateri', compact('data'));
    }

    function uploadMateri(){
        return view('pages/teacher/uploadMateri');
    }

    function updateMateri($id, Request $request){
        $data = Materis::find($id);
        $data->update($request->all());
        return redirect()->route('materi');
    }

    function soal(){
        $data = Questions::all();
        return view('pages/teacher/soal', compact('data'));
    }

    function Tambahsoal(){
        $materi = Materis::all();
        return view('pages/teacher/tambahSoal', compact('materi'));
    }

    function deleteSoal($id){
        $data = Questions::find($id);
        $data->delete();
        return redirect()->route('soal');
    }

    // function uploadSoal(Request $request){
    //     Questions::create($request->all());
    //     return redirect()->route('soal');
    // }

    public function uploadSoal(Request $request){
        $request->validate([
            'soal' => 'required',
            'score' => 'required|integer',
            'answer_key' => 'required',
            'id_materi' => 'required|exists:materis,id',
            'answers.*.option_alphabet' => 'required|string',
            'answers.*.option_text' => 'required|string',
        ]);

        $question = Questions::create([
            'soal' => $request->soal,
            'score' => $request->score,
            'answer_key' => $request->answer_key,
            'id_materi' => $request->id_materi,
        ]);

        foreach ($request->answers as $answerData) {
            Answers::create([
                'option_alphabet' => $answerData['option_alphabet'],
                'option_text' => $answerData['option_text'],
                'id_questions' => $question->id,
            ]);
        }

        return redirect()->route('soal')->with('success', 'Question and answers have been added successfully.');
    }

    public function jawaban(){
        $data = DB::table('questions')
            ->join('answers', 'questions.id', '=', 'answers.id_questions')
            ->select('questions.id as question_id', 'questions.soal', 'answers.id', 'answers.jawaban', 'answers.poin')
            ->get();
    
        return view('pages.teacher.jawaban', ['data' => $data]);
    }

    function tambahJawaban(){
        $jawaban = Answers::all();
        $soal = Questions::all();
        return view('pages/teacher/tambahJawaban', compact('soal','jawaban'));
    }

    public function uploadJawaban(Request $request){
        Log::info('Request data:', $request->all());
        $request->validate([
            'id_questions' => 'required|exists:questions,id',
            'inputs.*.jawaban' => 'required|string',
            'inputs.*.poin' => 'required|numeric',
        ]);
    
        $id_questions = $request->input('id_questions');
    
        foreach ($request->inputs as $value) {    
            Answers::create([
                'id_questions' => $id_questions,
                'jawaban' => $value['jawaban'],
                'poin' => $value['poin'],
            ]);
        }
    
        return redirect()->route('jawaban');
    }

    function essay(){
        $data = Materis::all();
        return view('pages/teacher/essay', compact('data'));
    }

    public function uploadEssay(Request $request)
    {
        $request->validate([
            'soal' => 'required',
            'inputs.*.jawaban_essay' => 'required',
            'inputs.*.essay_score' => 'required|integer',
        ]);

        $question = Questions::create([
            'soal' => $request->soal,
            'id_materi' => $request->id_materi,
        ]);

        foreach ($request->inputs as $input) {
            ResultEssay::create([
                'jawaban_essay' => $input['jawaban_essay'],
                'essay_score' => $input['essay_score'],
                'id_question' => $question->id,
            ]);
        }

        return redirect()->back()->with('success', 'Data berhasil disimpan.');
    }
}
