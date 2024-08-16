<?php

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\QuestionsController;
use App\Http\Controllers\SesiController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\Teacher\StudentController as TeacherStudentController;
use App\Http\Controllers\TeacherController;
use App\Models\Assignments;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth/login');
});

Route::get('/logout',function(){
    Auth::logout();
    return redirect('/');
});

Auth::routes();

Route::post('login', [SesiController::class, 'login']);

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [App\Http\Controllers\HomeController::class, 'index'])->name('admin');
    Route::get('kelas', [KelasController::class, 'kelas'])->name('kelas');
    Route::get('tampildata/{id}', [KelasController::class, 'tampildata'])->name('tampildata');
    Route::get('deleteKelas/{id}', [KelasController::class, 'deleteKelas'])->name('deleteKelas');
    Route::post('tambahKelas', [KelasController::class, 'tambahKelas']);
    Route::get('siswa', [StudentController::class, 'siswa'])->name('siswa');
    Route::post('tambahSiswa', [StudentController::class, 'tambahSiswa']);
    Route::get('tampildataSiswa/{id}', [StudentController::class, 'tampildataSiswa'])->name('tampildataSiswa');
    Route::get('deleteSiswa/{id}', [StudentController::class, 'deleteSiswa'])->name('deleteSiswa');
    Route::get('/materi', [MateriController::class, 'materi'])->name('materi');
    Route::get('uploadMateri', [MateriController::class, 'uploadMateri'])->name('uploadMateri');
    Route::get('detailMateri/{id}', [MateriController::class, 'detailMateri'])->name('detailMateri');
    Route::get('tampildataMateri/{id}', [MateriController::class, 'tampildataMateri'])->name('tampildataMateri');
    Route::get('/deleteMateri/{id}', [MateriController::class, 'deleteMateri'])->name('deleteMateri');
    Route::get('/penugasan', [AssignmentController::class, 'showPenugasan'])->name('penugasan');
    Route::get('/detailTugasPilihan/{id}', [AssignmentController::class, 'detailTugasPilihan'])->name('detailTugasPilihan');
    Route::get('/tampildataPenugasan/{id}', [AssignmentController::class, 'tampildataPenugasan'])->name('tampildataPenugasan');
    Route::get('/deleteAssignment/{id}', [AssignmentController::class, 'deleteAssignment'])->name('deleteAssignment');
    Route::get('tampildataSoal/{id}', [QuestionsController::class, 'tampildataSoal'])->name('tampildataSoal');
    Route::get('tampildataSoalEssay/{id}', [QuestionsController::class, 'tampildataSoalEssay'])->name('tampildataSoalEssay');
    Route::post('updateKelas/{id}', [KelasController::class, 'updateKelas'])->name('updateKelas');
    Route::post('updatePilihan/{id}', [QuestionsController::class, 'updatePilihan'])->name('updatePilihan');
    Route::post('updateEssay/{id}', [QuestionsController::class, 'updateEssay'])->name('updateEssay');
    Route::get('deleteSoalEssay/{id}', [QuestionsController::class, 'deleteSoalEssay'])->name('deleteSoalEssay');
    Route::post('updateSiswa/{id}', [StudentController::class, 'updateSiswa'])->name('updateSiswa');
    Route::post('tambahMateri', [MateriController::class, 'tambahMateri']);
    Route::post('updateMateri/{id}', [MateriController::class, 'updateMateri']);
    Route::get('/soal', [QuestionsController::class, 'soal'])->name('soal');
    Route::get('/tambahSoal/{id}', [AssignmentController::class, 'tambahSoal'])->name('tambahSoal');
    Route::post('uploadSoal', [QuestionsController::class, 'uploadSoal']);
    Route::get('deleteSoal/{id}', [QuestionsController::class, 'deleteSoal'])->name('deleteSoal');
    Route::post('updatePenugasan/{id}', [AssignmentController::class, 'updatePenugasan'])->name('updatePenugasan');
    Route::get('/tambahTugas', [AssignmentController::class, 'tambahTugas'])->name('tambahTugas');
    Route::post('/submitTugas', [AssignmentController::class, 'submitTugas'])->name('submitTugas');
    Route::get('/detailTugasEssay/{id}', [AssignmentController::class, 'detailTugasEssay'])->name('detailTugasEssay');
    Route::get('/pembelajaran', [TeacherController::class, 'pembelajaran'])->name('pembelajaran');
    Route::get('tambahJawaban', [AnswerController::class, 'tambahJawaban'])->name('tambahJawaban');
    Route::post('uploadJawaban', [AnswerController::class, 'uploadJawaban']);
    Route::get('essay/{id}', [AssignmentController::class, 'essay'])->name('essay');
    Route::get('/detailScore/{id}', [App\Http\Controllers\TeacherController::class, 'show'])->name('detailScore');
    Route::post('/uploadEssay', [QuestionsController::class, 'uploadEssay'])->middleware('auth')->name('uploadEssay');
    Route::get('/detailScore/{score_id}/detailJawaban/{id}', [AnswerController::class, 'detailJawaban'])->name('detailJawaban.show');
});


Route::middleware(['auth', 'user'])->group(function () {
    Route::get('/user', [App\Http\Controllers\StudentController::class, 'users'])->name('user');
    Route::get('jawaban', [AnswerController::class, 'jawaban'])->name('jawaban');
    Route::get('materiStudent', [MateriController::class, 'materiStudent'])->name('materiStudent');
    Route::get('detailMateriStudent/{id}', [MateriController::class, 'detailMateriStudent'])->name('detailMateriStudent');
    Route::get('pilihan', [QuestionsController::class, 'pilihan'])->name('pilihan');
    Route::get('/detailPilihan/{id_assignment}/{page?}', [QuestionsController::class, 'detailPilihan'])->name('detailPilihan');
    Route::post('/submit', [AnswerController::class, 'submit'])->middleware('auth')->name('submit');
    Route::get('show', [QuestionsController::class, 'show'])->name('show');
    Route::get('hasilPilihan/{userId}/{materiId}', [StudentController::class, 'showScore'])->name('hasilPilihan');
    Route::get('hasilEssay/{id}/{materiId}', [MateriController::class, 'hasilEssay'])->name('hasilEssay');
    Route::get('detailEssay/{id}/{page?}', [QuestionsController::class, 'detailEssay'])->name('detailEssay');
    Route::post('saveAnswer', [AnswerController::class, 'saveAnswer'])->name('saveAnswer');
    Route::get('pilihKelas', [TeacherController::class, 'pilihKelas'])->name('pilihKelas');
    Route::get('/question/{page}', [AnswerController::class, 'detailEssay'])->name('question');
    Route::get('hasilPembelajaran', [StudentController::class, 'hasilPembelajaran'])->name('hasilPembelajaran');
    Route::get('deskripsiEssay/{id}', [AssignmentController::class, 'deskripsiEssay'])->name('deskripsiEssay');
    Route::get('deskripsiPilihan/{id}', [AssignmentController::class, 'deskripsiPilihan'])->name('PilihanGanda');
    Route::get('detailTugas/{id}', [StudentController::class, 'detailTugas'])->name('detailTugas');
});