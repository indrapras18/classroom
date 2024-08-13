<?php

namespace App\Http\Controllers;

use App\Models\Answers;
use App\Models\Assignments;
use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Materi;
use App\Models\Materis;
use App\Models\Questions;
use App\Models\ResultEssay;
use App\Models\Results;
use App\Models\StudentScore;
use App\Models\StudentScores;
use App\Models\User;
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AnswerController extends Controller
{
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

    public function saveAnswer(Request $request){
        $userId = Auth::id();
        $answers = $request->input('answers');
        $assignmentId = $request->input('id_assignments');
        $currentPage = $request->input('currentPage');
        $action = $request->input('action');
    
        foreach ($answers as $questionId => $answerText) {
            $question = Questions::find($questionId);
            if ($question) {
                Results::updateOrCreate(
                    [
                        'id_user' => $userId,
                        'id_question' => $questionId,
                    ],
                    [
                        'answer_text' => $answerText,
                    ]
                );
            }
        }
    
        if ($action == 'next' || $action == 'previous') {
            $route = $action == 'next' 
                ? route('detailEssay', ['id' => $assignmentId, 'page' => $currentPage + 1])
                : route('detailEssay', ['id' => $assignmentId, 'page' => $currentPage - 1]);
    
            return redirect($route);
        }
    
        $totalScore = 0;
        $results = DB::table('results')
            ->join('questions', 'results.id_question', '=', 'questions.id')
            ->join('result_essays', 'results.id_question', '=', 'result_essays.id_question')
            ->where('results.id_user', $userId)
            ->where('questions.id_assignment', $assignmentId)
            ->select('result_essays.essay_score', 'results.answer_text', 'result_essays.jawaban_essay')
            ->get();
    
        foreach ($results as $result) {
            if (str_contains($result->answer_text, $result->jawaban_essay)) {
                $totalScore += $result->essay_score;
            }
        }
    
        StudentScores::updateOrCreate(
            ['id_user' => $userId, 'id_assignments' => $assignmentId],
            ['total_score' => $totalScore]
        );
    
        return redirect()->route('pilihan')->with('success', 'Jawaban berhasil disimpan dan skor dihitung.');
    }
    
    public function submit(Request $request)
{
    $userId = Auth::id();
    $answers = $request->input('answers');
    $assignmentId = $request->input('id_assignments');
    $currentPage = $request->input('currentPage');
    $action = $request->input('action');

    // Validasi untuk memastikan bahwa jawaban telah dipilih
    if (!$answers || !is_array($answers)) {
        return redirect()->back()->withErrors('Anda harus memilih salah satu jawaban sebelum melanjutkan.');
    }

    // Proses jawaban yang diterima
    foreach ($answers as $questionId => $answerId) {
        $answer = Answers::find($answerId);
        if ($answer) {
            Results::updateOrCreate(
                [
                    'id_user' => $userId,
                    'id_question' => $questionId,
                ],
                [
                    'answer_text' => $answer->option_text,
                ]
            );
        }
    }

    if ($action == 'next' || $action == 'previous') {
        $route = $action == 'next' 
            ? route('detailPilihan', ['id_assignment' => $assignmentId, 'page' => $currentPage + 1])
            : route('detailPilihan', ['id_assignment' => $assignmentId, 'page' => $currentPage - 1]);

        return redirect($route);
    }

    $totalScore = DB::table('results')
        ->join('questions', 'results.id_question', '=', 'questions.id')
        ->join('answers', function($join) {
            $join->on('results.answer_text', '=', 'answers.option_text')
                 ->on('results.id_question', '=', 'answers.id_questions');
        })
        ->where('results.id_user', $userId)
        ->where('questions.id_assignment', $assignmentId)
        ->whereColumn('questions.answer_key', 'answers.option_alphabet')
        ->sum('questions.score');

    StudentScores::updateOrCreate(
        ['id_user' => $userId, 'id_assignments' => $assignmentId],
        ['total_score' => $totalScore]
    );

    return redirect()->route('pilihan')->with('success', 'Jawaban berhasil disimpan dan skor dihitung.');
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
    
    public function detailJawaban($scoreId, $id) {
        $jawaban = DB::table('results')
                ->join('questions', 'results.id_question', '=', 'questions.id')
                ->where('questions.id_assignment', $id)
                ->select('results.*', 'questions.soal')
                ->get();
    return view('pages/teacher/detailJawaban', compact('jawaban', 'scoreId'));
}

}
