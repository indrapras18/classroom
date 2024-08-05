<?php

namespace App\Http\Controllers;

use App\Models\Answers;
use App\Models\Materis;
use App\Models\Questions;
use App\Models\ResultEssay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuestionsController extends Controller
{
    public function uploadSoal(Request $request) {
        $request->validate([
            'soal' => 'required',
            'score' => 'required|integer',
            'answer_key' => 'required',
            'id_assignment' => 'required|exists:assignments,id',
            'answers.*.option_alphabet' => 'required|string',
            'answers.*.option_text' => 'required|string',
        ]);
    
        $question = Questions::create([
            'soal' => $request->soal,
            'score' => $request->score,
            'answer_key' => $request->answer_key,
            'id_assignment' => $request->id_assignment,
        ]);
    
    
        foreach ($request->answers as $answerData) {
            Answers::create([
                'option_alphabet' => $answerData['option_alphabet'],
                'option_text' => $answerData['option_text'],
                'id_questions' => $question->id,
            ]);
        }
        return redirect()->route('penugasan')->with('success', 'Question and answers have been added successfully.');
    }

    function tampildataSoal($id){
        $data = Questions::find($id);
        return view('pages/teacher/tampildataSoal', compact('data'));
    }

    function soal(){
        $data = Questions::all();
        return view('pages/teacher/soal', compact('data'));
    }

    function deleteSoal($id){
        $data = Questions::find($id);
        $data->delete();
        return redirect()->route('penugasan');
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
            'id_assignment' => $request->id_assignment,
        ]);
    
        foreach ($request->inputs as $input) {
            ResultEssay::create([
                'jawaban_essay' => $input['jawaban_essay'],
                'essay_score' => $input['essay_score'],
                'id_question' => $question->id,
            ]);
        }
    
        return redirect()->route('penugasan')->with('success', 'Data berhasil disimpan.');
    }

    function deleteSoalEssay($id){
        $data = Questions::find($id);
        $data->delete();
        return redirect()->route('penugasan');
    }

    public function updateEssay(Request $request, $id){
        $question = Questions::find($id);
    
        if (!$question) {
            return redirect()->back()->with('error', 'Question not found.');
        }
    
        $question->update([
            'soal' => $request->input('soal'),
        ]);
    
        $essay_ids = $request->input('essay_ids', []);
        $jawaban_essays = $request->input('jawaban_essay', []);
        $essay_scores = $request->input('essay_score', []);
    
        foreach ($essay_ids as $index => $essay_id) {
            $essay = ResultEssay::find($essay_id);
    
            if ($essay) {
                $essay->update([
                    'jawaban_essay' => $jawaban_essays[$index],
                    'essay_score' => $essay_scores[$index],
                ]);
            }
        }
    
        return redirect('/penugasan')->with('success', 'Data updated successfully.');
    }

    function tampildataSoalEssay($id){
        $data = Questions::with('resultEssays')->find($id);
        if (!$data) {
            return redirect()->back()->with('error', 'Question not found.');
        }
    
        return view('pages/teacher/tampildataSoalEssay', compact('data'));
    }

    public function pilihan() {
        $materiWithScore = DB::table('assignments')
            ->join('questions', 'assignments.id', '=', 'questions.id_assignment')
            ->where('questions.score', '>', 0)
            ->select('assignments.*')
            ->distinct()
            ->get();
    
        $materiWithoutScore = DB::table('assignments')
            ->whereIn('id', function($query) {
                $query->select('id_assignment')
                    ->from('questions')
                    ->whereNull('score')
                    ->orWhereNull('answer_key');
            })
            ->get();
    
        return view('pages/student/pilihan', compact('materiWithScore', 'materiWithoutScore'));
    }

    public function detailPilihan($id_assignment) {
        $assignment = DB::table('assignments')->find($id_assignment);
        $soal = DB::table('questions')
            ->join('answers', 'questions.id', '=', 'answers.id_questions')
            ->where('questions.id_assignment', $id_assignment)
            ->select('questions.id as question_id', 'questions.soal', 'questions.score', 'questions.answer_key', 'answers.id as answer_id', 'answers.option_alphabet', 'answers.option_text')
            ->get()
            ->groupBy('question_id');
        $listSoal = Questions::where('id_assignment', $id_assignment)->get();
        
        return view('pages/student/detailPilihan', compact('assignment', 'soal', 'listSoal'));
    }

    public function show()
    {
        $soal =  Questions::with('answers')->get();
        $materi = Materis::all();
        
        return view('detailPilihan', compact('soal', 'materi'));
    }

    public function detailEssay($id_assignment) {
        $questionsWithoutScore = DB::table('questions')
            ->where('id_assignment', $id_assignment)
            ->whereNull('score')
            ->get();
    
        $materi = DB::table('assignments')->find($id_assignment);
        
        return view('pages/student/detailEssay', compact('materi', 'questionsWithoutScore'));
    }

    function updatePilihan($id, Request $request){
        $data = Questions::find($id);
        $data->update($request->all());
        return redirect()->route('penugasan');
    }
}
