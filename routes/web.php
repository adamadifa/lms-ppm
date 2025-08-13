<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\MataPelajaranController;
use App\Http\Controllers\Admin\KelasController;
use App\Http\Controllers\Guru\MateriController as GuruMateriController;
use App\Http\Controllers\Guru\LKSController;
use App\Http\Controllers\Guru\MateriVideoController;
use App\Http\Controllers\Guru\QuizController;
use App\Http\Controllers\Guru\PenilaianController;
use App\Http\Controllers\Siswa\MateriController as SiswaMateriController;
use App\Http\Controllers\Siswa\LKSController as SiswaLKSController;
use App\Http\Controllers\Siswa\QuizController as SiswaQuizController;
use App\Http\Controllers\Siswa\NilaiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Training route
    Route::get('/training', function () {
        return view('training');
    })->name('training');

    // Admin Routes
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::resource('users', UserController::class);
        Route::resource('mata-pelajaran', MataPelajaranController::class);
        Route::resource('kelas', KelasController::class);
    });

    // Guru Routes
    Route::middleware('role:guru')->prefix('guru')->name('guru.')->group(function () {
        Route::resource('materi', GuruMateriController::class);
        Route::resource('lks', LKSController::class)->parameters(['lks' => 'lks']);
        Route::get('materi/{materi}/create-lks', [LKSController::class, 'createFromMateri'])->name('materi.create-lks');
        Route::get('materi/{materi}/create-quiz', [QuizController::class, 'createFromMateri'])->name('materi.create-quiz');
        Route::resource('materi-video', MateriVideoController::class);
        Route::get('materi/{materi}/videos', [MateriVideoController::class, 'showByMateri'])->name('materi.videos');
        Route::resource('quiz', QuizController::class);
        Route::get('quiz/{quiz}/soal', [QuizController::class, 'soal'])->name('quiz.soal');
        Route::post('quiz/{quiz}/soal', [QuizController::class, 'storeSoal'])->name('quiz.store-soal');
        Route::delete('quiz/{quiz}/soal/{soal}', [QuizController::class, 'destroySoal'])->name('quiz.destroy-soal');
        Route::resource('penilaian', PenilaianController::class);
    });

    // Siswa Routes
    Route::middleware('role:siswa')->prefix('siswa')->name('siswa.')->group(function () {
        Route::resource('materi', SiswaMateriController::class)->only(['index', 'show']);
        Route::get('materi/filter', [SiswaMateriController::class, 'filter'])->name('materi.filter');
        Route::get('lks', [SiswaLKSController::class, 'index'])->name('lks.index');
        Route::get('lks/{id}', [SiswaLKSController::class, 'show'])->name('lks.show');
        Route::post('lks/{id}/submit', [SiswaLKSController::class, 'submit'])->name('lks.submit');
        Route::resource('quiz', SiswaQuizController::class)->only(['index', 'show']);
        Route::get('quiz/{quiz}/kerjakan', [SiswaQuizController::class, 'kerjakan'])->name('quiz.kerjakan');
        Route::post('quiz/{quiz}/submit', [SiswaQuizController::class, 'submit'])->name('quiz.submit');
        Route::resource('nilai', NilaiController::class)->only(['index', 'show']);
        Route::get('nilai/quiz/{id}', [NilaiController::class, 'showQuiz'])->name('nilai.show-quiz');
        Route::get('nilai/lks/{id}', [NilaiController::class, 'showLKS'])->name('nilai.show-lks');
    });
});

require __DIR__ . '/auth.php';
