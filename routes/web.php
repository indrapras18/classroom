<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\SesiController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
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
    return view('Auth/login');
});

Auth::routes();

Route::post('login', [SesiController::class, 'login']);

Route::middleware(['auth'])->group(function(){

Route::get('kelas', [TeacherController::class, 'kelas'])->name('kelas');

Route::get('siswa', [TeacherController::class, 'siswa'])->name('siswa');

Route::get('pilihKelas', [TeacherController::class, 'pilihKelas'])->name('pilihKelas');

Route::post('tambahKelas', [TeacherController::class, 'tambahKelas']);

Route::post('tambahSiswa', [TeacherController::class, 'tambahSiswa']);

Route::get('tampildata/{id}', [TeacherController::class, 'tampildata'])->name('tampildata');

Route::post('updateKelas/{id}', [TeacherController::class, 'updateKelas'])->name('updateKelas');

Route::get('deleteKelas/{id}', [TeacherController::class, 'deleteKelas'])->name('deleteKelas');

Route::get('tampildataSiswa/{id}', [TeacherController::class, 'tampildataSiswa'])->name('tampildataSiswa');

Route::post('updateSiswa/{id}', [TeacherController::class, 'updateSiswa'])->name('updateSiswa');

Route::get('deleteSiswa/{id}', [TeacherController::class, 'deleteSiswa'])->name('deleteSiswa');

Route::get('/materi', [TeacherController::class, 'materi'])->name('materi');

Route::post('tambahMateri', [TeacherController::class, 'tambahMateri']);

Route::get('/deleteMateri/{id}', [TeacherController::class, 'deleteMateri'])->name('deleteMateri');

Route::get('tampildataMateri/{id}', [TeacherController::class, 'tampildataMateri'])->name('tampildataMateri');

Route::get('detailMateri/{id}', [TeacherController::class, 'detailMateri'])->name('detailMateri');

Route::get('uploadMateri', [TeacherController::class, 'uploadMateri'])->name('uploadMateri');

Route::post('updateMateri/{id}', [TeacherController::class, 'updateMateri']);

Route::get('/soal', [TeacherController::class, 'soal'])->name('soal');

Route::get('/tambahSoal', [TeacherController::class, 'tambahSoal'])->name('tambahSoal');

Route::post('uploadSoal', [TeacherController::class, 'uploadSoal']);

Route::get('deleteSoal/{id}', [TeacherController::class, 'deleteSoal'])->name('deleteSoal');

Route::get('jawaban', [TeacherController::class, 'jawaban'])->name('jawaban');

Route::get('tambahJawaban', [TeacherController::class, 'tambahJawaban'])->name('tambahJawaban');

Route::post('uploadJawaban', [TeacherController::class, 'uploadJawaban']);

Route::get('materiStudent', [StudentController::class, 'materiStudent'])->name('materiStudent');

Route::get('detailMateriStudent/{id}', [StudentController::class, 'detailMateriStudent'])->name('detailMateriStudent');

Route::get('pilihan', [StudentController::class, 'pilihan'])->name('pilihan');

Route::get('detailPilihan/{id}', [StudentController::class, 'detailPilihan'])->name('detailPilihan');

Route::post('/submit', [StudentController::class, 'submit'])->middleware('auth')->name('submit');

Route::get('show', [StudentController::class, 'show'])->name('show');

Route::get('hasilPilihan/{userId}/{materiId}', [StudentController::class, 'showScore'])->name('hasilPilihan');

Route::get('essay', [TeacherController::class, 'essay'])->name('essay');

Route::get('hasilEssay/{id}/{materiId}', [StudentController::class, 'hasilEssay'])->name('hasilEssay');

Route::post('/uploadEssay', [TeacherController::class, 'uploadEssay'])->middleware('auth')->name('uploadEssay');

Route::get('detailEssay/{id}', [StudentController::class, 'detailEssay'])->name('detailEssay');

Route::post('saveAnswer', [StudentController::class, 'saveAnswer'])->name('saveAnswer');

Route::get('/admin', [App\Http\Controllers\HomeController::class, 'index'])->name('admin');

Route::get('/user', [App\Http\Controllers\HomeController::class, 'users'])->name('user');

Route::get('/pembelajaran', [TeacherController::class, 'pembelajaran'])->name('pembelajaran');

});

Route::get('/logout',function(){
    Auth::logout();
    return redirect('/');
});
