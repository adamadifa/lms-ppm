<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use App\Models\Materi;
use App\Models\Kelas;
use App\Models\SoalQuiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:guru');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $quiz = Quiz::where('guru_id', auth()->id())
            ->with(['materi', 'kelas'])
            ->paginate(10);
        return view('guru.quiz.index', compact('quiz'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $materi = Materi::where('status', 'publikasi')->get();
        $kelas = Kelas::where('status', 'aktif')->get();
        return view('guru.quiz.create', compact('materi', 'kelas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:200',
            'deskripsi' => 'nullable|string',
            'materi_id' => 'required|exists:materi,id',
            'kelas_id' => 'required|exists:kelas,id',
            'waktu_mulai' => 'nullable|date|after:now',
            'waktu_selesai' => 'nullable|date|after:waktu_mulai',
            'durasi' => 'required|integer|min:1|max:180',
            'jumlah_soal' => 'required|integer|min:1|max:100',
            'passing_score' => 'required|integer|min:0|max:100',
            'status' => 'required|in:draft,aktif,selesai'
        ]);

        $data = $request->all();
        $data['guru_id'] = auth()->id();

        Quiz::create($data);

        return redirect()->route('guru.quiz.index')->with('success', 'Quiz berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Quiz $quiz)
    {
        if ($quiz->guru_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $soal = $quiz->soalQuiz()->orderBy('urutan')->get();
        $hasil = $quiz->hasilQuiz()->with('siswa')->get();

        return view('guru.quiz.show', compact('quiz', 'soal', 'hasil'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Quiz $quiz)
    {
        if ($quiz->guru_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $materi = Materi::where('status', 'publikasi')->get();
        $kelas = Kelas::where('status', 'aktif')->get();
        return view('guru.quiz.edit', compact('quiz', 'materi', 'kelas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Quiz $quiz)
    {
        if ($quiz->guru_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'judul' => 'required|string|max:200',
            'deskripsi' => 'nullable|string',
            'mata_pelajaran_id' => 'required|exists:mata_pelajaran,id',
            'kelas_id' => 'required|exists:kelas,id',
            'waktu_mulai' => 'nullable|date|after:now',
            'waktu_selesai' => 'nullable|date|after:waktu_mulai',
            'durasi' => 'required|integer|min:1|max:180',
            'jumlah_soal' => 'required|integer|min:1|max:100',
            'passing_score' => 'required|integer|min:0|max:100',
            'status' => 'required|in:draft,aktif,selesai'
        ]);

        $quiz->update($request->all());

        return redirect()->route('guru.quiz.index')->with('success', 'Quiz berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Quiz $quiz)
    {
        if ($quiz->guru_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $quiz->delete();
        return redirect()->route('guru.quiz.index')->with('success', 'Quiz berhasil dihapus!');
    }

    /**
     * Show soal management for quiz
     */
    public function soal(Quiz $quiz)
    {
        if ($quiz->guru_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $soal = $quiz->soalQuiz()->orderBy('urutan')->get();
        return view('guru.quiz.soal', compact('quiz', 'soal'));
    }

    /**
     * Store soal for quiz
     */
    public function storeSoal(Request $request, Quiz $quiz)
    {
        if ($quiz->guru_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'pertanyaan' => 'required|string',
            'tipe_soal' => 'required|in:pilihan_ganda,essay',
            'opsi_a' => 'nullable|string|required_if:tipe_soal,pilihan_ganda',
            'opsi_b' => 'nullable|string|required_if:tipe_soal,pilihan_ganda',
            'opsi_c' => 'nullable|string|required_if:tipe_soal,pilihan_ganda',
            'opsi_d' => 'nullable|string|required_if:tipe_soal,pilihan_ganda',
            'jawaban_benar' => 'nullable|string|required_if:tipe_soal,pilihan_ganda',
            'bobot_nilai' => 'required|integer|min:1|max:10',
            'urutan' => 'required|integer|min:1'
        ]);

        $data = $request->all();
        $data['quiz_id'] = $quiz->id;

        SoalQuiz::create($data);

        return redirect()->route('guru.quiz.soal', $quiz)->with('success', 'Soal berhasil ditambahkan!');
    }
}
