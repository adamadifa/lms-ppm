<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use App\Models\HasilQuiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:siswa');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get user's class
        $userKelas = auth()->user()->kelas_id ?? null;

        if ($userKelas) {
            $quiz = Quiz::where('kelas_id', $userKelas)
                ->where('status', 'aktif')
                ->with(['materi', 'kelas', 'guru'])
                ->orderBy('created_at', 'desc')
                ->paginate(12);
        } else {
            // If no class assigned, show all active quizzes
            $quiz = Quiz::where('status', 'aktif')
                ->with(['materi', 'kelas', 'guru'])
                ->orderBy('created_at', 'desc')
                ->paginate(12);
        }

        return view('siswa.quiz.index', compact('quiz'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Quiz $quiz)
    {
        // Check if quiz is active
        if ($quiz->status !== 'aktif') {
            abort(404, 'Quiz tidak ditemukan.');
        }

        // Check if user can access this quiz (same class or general access)
        $userKelas = auth()->user()->kelas_id ?? null;
        if ($userKelas && $quiz->kelas_id !== $userKelas) {
            abort(403, 'Anda tidak memiliki akses ke quiz ini.');
        }

        // Get user's quiz result
        $hasil = HasilQuiz::where('quiz_id', $quiz->id)
            ->where('siswa_id', auth()->id())
            ->first();

        // Get quiz questions
        $soal = $quiz->soalQuiz()->orderBy('urutan')->get();

        return view('siswa.quiz.show', compact('quiz', 'hasil', 'soal'));
    }

    /**
     * Mulai mengerjakan quiz
     */
    public function kerjakan(Quiz $quiz)
    {
        // Check if quiz is active
        if ($quiz->status !== 'aktif') {
            abort(404, 'Quiz tidak ditemukan.');
        }

        // Check if user can access this quiz
        $userKelas = auth()->user()->kelas_id ?? null;
        if ($userKelas && $quiz->kelas_id !== $userKelas) {
            abort(403, 'Anda tidak memiliki akses ke quiz ini.');
        }

        // Check if user already completed this quiz
        $hasil = HasilQuiz::where('quiz_id', $quiz->id)
            ->where('siswa_id', auth()->id())
            ->first();

        if ($hasil) {
            return redirect()->route('siswa.quiz.show', $quiz)->with('error', 'Anda sudah mengerjakan quiz ini.');
        }

        // Check quiz schedule
        if ($quiz->waktu_mulai && now()->isBefore($quiz->waktu_mulai)) {
            return redirect()->route('siswa.quiz.show', $quiz)->with('error', 'Quiz belum dimulai.');
        }

        if ($quiz->waktu_selesai && now()->isAfter($quiz->waktu_selesai)) {
            return redirect()->route('siswa.quiz.show', $quiz)->with('error', 'Quiz sudah selesai.');
        }

        // Get quiz questions
        $soal = $quiz->soalQuiz()->orderBy('urutan')->get();

        if ($soal->isEmpty()) {
            return redirect()->route('siswa.quiz.show', $quiz)->with('error', 'Quiz belum memiliki soal.');
        }

        return view('siswa.quiz.kerjakan', compact('quiz', 'soal'));
    }

    /**
     * Submit quiz answers
     */
    public function submit(Request $request, Quiz $quiz)
    {
        // Check if quiz is active
        if ($quiz->status !== 'aktif') {
            abort(404, 'Quiz tidak ditemukan.');
        }

        // Check if user can access this quiz
        $userKelas = auth()->user()->kelas_id ?? null;
        if ($userKelas && $quiz->kelas_id !== $userKelas) {
            abort(403, 'Anda tidak memiliki akses ke quiz ini.');
        }

        // Check if user already completed this quiz
        $hasil = HasilQuiz::where('quiz_id', $quiz->id)
            ->where('siswa_id', auth()->id())
            ->first();

        if ($hasil) {
            return redirect()->route('siswa.quiz.show', $quiz)->with('error', 'Anda sudah mengerjakan quiz ini.');
        }

        // Check quiz schedule
        if ($quiz->waktu_selesai && now()->isAfter($quiz->waktu_selesai)) {
            return redirect()->route('siswa.quiz.show', $quiz)->with('error', 'Quiz sudah selesai.');
        }

        // Validate answers
        $request->validate([
            'jawaban' => 'required|array',
            'jawaban.*' => 'required|string'
        ]);

        // Get quiz questions
        $soal = $quiz->soalQuiz()->orderBy('urutan')->get();

        // Calculate score
        $benar = 0;
        $total = $soal->count();

        foreach ($soal as $s) {
            $jawabanSiswa = $request->jawaban[$s->id] ?? '';

            // Get the correct answer text based on jawaban_benar (A, B, C, D)
            $kunciJawabanText = '';
            switch (strtolower($s->jawaban_benar)) {
                case 'a':
                    $kunciJawabanText = $s->opsi_a;
                    break;
                case 'b':
                    $kunciJawabanText = $s->opsi_b;
                    break;
                case 'c':
                    $kunciJawabanText = $s->opsi_c;
                    break;
                case 'd':
                    $kunciJawabanText = $s->opsi_d;
                    break;
            }

            if (strtolower(trim($jawabanSiswa)) === strtolower(trim($kunciJawabanText))) {
                $benar++;
            }
        }

        $nilai = ($benar / $total) * 100;
        $lulus = $nilai >= $quiz->passing_score;

        // Save quiz result
        $hasil = HasilQuiz::create([
            'quiz_id' => $quiz->id,
            'siswa_id' => auth()->id(),
            'nilai' => round($nilai, 2),
            'jumlah_benar' => $benar,
            'jumlah_salah' => $total - $benar,
            'total_soal' => $total,
            'status' => $lulus ? 'lulus' : 'tidak_lulus',
            'waktu_mulai' => now(),
            'waktu_selesai' => now()
        ]);

        // Save individual answers
        foreach ($soal as $s) {
            $jawabanSiswa = $request->jawaban[$s->id] ?? '';

            // Get the correct answer text based on jawaban_benar (A, B, C, D)
            $kunciJawabanText = '';
            switch (strtolower($s->jawaban_benar)) {
                case 'a':
                    $kunciJawabanText = $s->opsi_a;
                    break;
                case 'b':
                    $kunciJawabanText = $s->opsi_b;
                    break;
                case 'c':
                    $kunciJawabanText = $s->opsi_c;
                    break;
                case 'd':
                    $kunciJawabanText = $s->opsi_d;
                    break;
            }

            $isCorrect = strtolower(trim($jawabanSiswa)) === strtolower(trim($kunciJawabanText));

            \App\Models\JawabanQuiz::create([
                'hasil_quiz_id' => $hasil->id,
                'soal_id' => $s->id,
                'jawaban_siswa' => $jawabanSiswa,
                'kunci_jawaban' => $kunciJawabanText,
                'benar' => $isCorrect
            ]);
        }

        return redirect()->route('siswa.quiz.show', $quiz)->with('success', 'Quiz berhasil diselesaikan! Nilai Anda: ' . round($nilai, 2));
    }
}
