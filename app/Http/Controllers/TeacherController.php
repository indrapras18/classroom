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

    // function essay(){pppppppppppppppp
    //     $data = Materis::all();
    //     return view('pages/teacher/essay', compact('data'));
    // }



    function pembelajaran()
    {
        $scores = StudentScores::with(['user', 'materi'])->get();

    
        return view('pages/teacher/pembelajaran', compact('scores'));
    }

}
