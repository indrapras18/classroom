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
use App\Models\StudentScore;
use App\Models\StudentScores;
use App\Models\User;
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class TeacherController extends Controller{

    public function pembelajaran()
    {
        $scores = StudentScores::with(['user', 'assignment'])->get();
        return view('pages.teacher.pembelajaran', compact('scores'));
    }

    public function show($id)
    {
        $score = StudentScores::find($id);
        if (!$score) {
            abort(404);
        }
        $userScores = StudentScores::where('id_user', $score->id_user)->with('assignment')->get();
        return view('pages.teacher.detailScore', compact('score', 'userScores'));
    }

    public function showUserScores($id)
{
    $userScore = StudentScores::with(['assignment.questions.results'])->find($id);
    return view('pages.teacher.detailScore', compact('userScore'));
}

}
