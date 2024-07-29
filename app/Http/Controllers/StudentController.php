<?php

namespace App\Http\Controllers;

use App\Models\Answers;
use App\Models\Materis;
use App\Models\Questions;
use App\Models\Results;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class StudentController extends Controller
{
    function materiStudent(){
        $materi = Materis::all();
        return view('pages/student/materiStudent', compact('materi'));
    }

    function detailMateriStudent($id){
        $data = Materis::find($id);
        return view('pages/student/detailMateriStudent', compact('data'));
    }

    function pilihan(){
    $materiWithScore = DB::table('materis')
        ->join('questions', 'materis.id', '=', 'questions.id_materi')
        ->where('questions.score', '>', 0)
        ->select('materis.*')
        ->distinct()
        ->get();

    $materiWithoutScore = DB::table('materis')
        ->whereNotIn('materis.id', function($query) {
            $query->select('id_materi')
                ->from('questions')
                ->where('score', '>', 0);
        })
        ->get();

    return view('pages/student/pilihan', compact('materiWithScore', 'materiWithoutScore'));
    }

    function detailPilihan($id_materi){
        $listSoal = Questions::all();
        $materi = DB::table('materis')->find($id_materi);
        $soal = DB::table('questions')
            ->join('answers', 'questions.id', '=', 'answers.id_questions')
            ->where('questions.id_materi', $id_materi)
            ->select('questions.id as question_id', 'questions.soal', 'answers.id as answer_id', 'answers.option_alphabet', 'answers.option_text')
            ->get()
            ->groupBy('question_id');
        return view('pages/student/detailPilihan', compact('materi', 'soal', 'listSoal'));
    }

    public function show()
    {
        $soal =  Questions::with('answers')->get();
        $materi = Materis::all();
        
        return view('detailPilihan', compact('soal', 'materi'));
    }

    public function submit(Request $request){
    $request->validate([
        'answers' => 'required|array',
        'answers.*' => 'required|exists:answers,id',
    ]);

    $user_id = Auth::id();
    $id_materi = $request->input('id_materi');
    $existingSubmission = Results::where('id_user', $user_id)->exists();

    if ($existingSubmission) {
        return redirect()->route('pilihan')->with('status', 'You have already submitted the quiz.');
    }

    foreach ($request->answers as $question_id => $answer_id) {
        $answer = Answers::find($answer_id);

        Results::create([
            'answer_text' => $answer->option_text,
            'id_user' => $user_id,
            'id_question' => $question_id,
        ]);
    }

    return redirect()->route('pilihan')->with('status', 'Quiz submitted successfully.');
}
    
    function showScore($userId, $materiId) {
        $totalScore = DB::table('results')
            ->join('questions', 'results.id_question', '=', 'questions.id')
            ->join('answers', function($join) {
                $join->on('results.answer_text', '=', 'answers.option_text')
                     ->on('results.id_question', '=', 'answers.id_questions');
            })
            ->where('results.id_user', $userId)
            ->where('questions.id_materi', $materiId)
            ->whereColumn('questions.answer_key', 'answers.option_alphabet')
            ->sum('questions.score');
        
        return view('pages/student/hasilPilihan', compact('totalScore'));
    }

    function detailEssay(){
        $questionsWithoutScore = Questions::whereNull('score')->get();
    
        return view('pages.student.detailEssay', compact('questionsWithoutScore'));
    }

    public function saveAnswer(Request $request){
        $userId = Auth::id();
        $answers = $request->input('answers');
    
        foreach ($answers as $questionId => $answerText) {
            $existingResult = Results::where('id_user', $userId)
                ->where('id_question', $questionId)
                ->exists();
    
            if (!$existingResult) {
                Results::create([
                    'answer_text' => $answerText,
                    'id_user' => $userId,
                    'id_question' => $questionId,
                ]);
            }
        }
    
        return redirect()->back()->with('success', 'Jawaban berhasil disimpan.');
    }

//     public function saveAnswer(Request $request)
// {
//     $request->validate([
//         'answers' => 'required|array',
//         'answers.*' => 'required|exists:answers,id',
//         'id_materi' => 'required|exists:materi,id', // Pastikan id_materi valid
//     ]);

//     $user_id = Auth::id();
//     $id_materi = $request->input('id_materi');

//     // Cek jika pengguna sudah pernah menyubmit
//     $existingSubmission = Results::where('id_user', $user_id)->exists();

//     if ($existingSubmission) {
//         return redirect()->route('pilihan')->with('status', 'You have already submitted the quiz.');
//     }

//     foreach ($request->answers as $question_id => $answer_id) {
//         $answer = Answers::find($answer_id);

//         Results::create([
//             'answer_text' => $answer->option_text,
//             'id_user' => $user_id,
//             'id_question' => $question_id,
//         ]);
//     }

//     $totalScore = DB::table('results')
//         ->join('questions', 'results.id_question', '=', 'questions.id')
//         ->join('result_essays', 'results.id_question', '=', 'result_essays.id_question')
//         ->where('results.id_user', $user_id)
//         ->where('questions.id_materi', $id_materi)
//         ->whereColumn('results.answer_text', 'result_essays.jawaban_essay')
//         ->sum('result_essays.essay_score');

//     DB::table('student_scores')->updateOrInsert(
//         ['id_user' => $user_id, 'id_materi' => $id_materi],
//         ['total_score' => $totalScore]
//     );

//     return redirect()->route('pages/student/hasilEssay', ['id_user' => $user_id, 'id_materi' => $id_materi])
//         ->with('status', 'Quiz submitted successfully.');
// }


    public function hasilEssay($userId,$materiId)
    {
        $totalScore = DB::table('results')
            ->join('questions', 'results.id_question', '=', 'questions.id')
            ->join('result_essays', 'results.id_question', '=', 'result_essays.id_question')
            ->where('results.id_user', $userId)
            ->where('questions.id_materi', $materiId)
            ->whereColumn('results.answer_text', 'result_essays.jawaban_essay')
            ->sum('result_essays.essay_score');

        return view('pages/student/hasilEssay', compact('totalScore'));
    }
}
