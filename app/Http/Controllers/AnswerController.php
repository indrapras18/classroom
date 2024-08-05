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

    public function saveAnswer(Request $request)
    {
        $userId = Auth::id();
        $answers = $request->input('answers');
    
        foreach ($answers as $questionId => $answerText) {
            $question = Questions::find($questionId);
            if ($question) {
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
        }
    
        $totalScore = DB::table('results')
            ->join('questions', 'results.id_question', '=', 'questions.id')
            ->join('result_essays', 'results.id_question', '=', 'result_essays.id_question')
            ->where('results.id_user', $userId)
            ->whereColumn('results.answer_text', 'result_essays.jawaban_essay')
            ->sum('result_essays.essay_score');
    
        StudentScores::updateOrCreate(
            ['id_user' => $userId],
            ['total_score' => $totalScore]
        );
    
        return redirect()->route('pilihan')->with('success', 'Jawaban berhasil disimpan dan skor dihitung.');
    }

    public function submit(Request $request){
        $request->validate([
            'answers' => 'required|array',
            'answers.*' => 'required|exists:answers,id',
        ]);
    
        $user_id = Auth::id();
    
        foreach ($request->answers as $question_id => $answer_id) {
            $existingSubmission = Results::where('id_user', $user_id)
                                         ->where('id_question', $question_id)
                                         ->exists();
    
            if ($existingSubmission) {
                return redirect()->route('pilihan')->with('status', 'You have already submitted the quiz for this question.');
            }
    
            $answer = Answers::find($answer_id);
    
            Results::create([
                'answer_text' => $answer->option_text,
                'id_user' => $user_id,
                'id_question' => $question_id,
            ]);
        }
    
        $totalScore = DB::table('results')
            ->join('questions', 'results.id_question', '=', 'questions.id')
            ->join('answers', function($join) {
                $join->on('results.answer_text', '=', 'answers.option_text')
                     ->on('results.id_question', '=', 'answers.id_questions');
            })
            ->where('results.id_user', $user_id)
            ->whereColumn('questions.answer_key', 'answers.option_alphabet')
            ->sum('questions.score');
    
        DB::table('student_scores')->insert([
            'id_user' => $user_id,
            'total_score' => $totalScore,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    
        return redirect()->route('pilihan')->with('status', 'Quiz submitted successfully.');
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
    
}
