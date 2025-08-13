<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use App\Models\Materi;
use App\Models\Kelas;
use App\Models\SoalQuiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
     * Show the form for creating a new quiz from specific materi.
     */
    public function createFromMateri(Materi $materi)
    {
        // Check if the materi belongs to the authenticated guru
        if ($materi->guru_id != auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

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
        if ($quiz->guru_id != auth()->id()) {
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
        if ($quiz->guru_id != auth()->id()) {
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
        if ($quiz->guru_id != auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        try {
            // Debug: Log request data
            Log::info('Quiz Update Request:', $request->all());

            $request->validate([
                'judul' => 'required|string|max:200',
                'deskripsi' => 'nullable|string',
                'materi_id' => 'required|exists:materi,id',
                'kelas_id' => 'required|exists:kelas,id',
                'waktu_mulai' => 'nullable|date',
                'waktu_selesai' => 'nullable|date|after:waktu_mulai',
                'durasi' => 'required|integer|min:1|max:180',
                'jumlah_soal' => 'required|integer|min:1|max:100',
                'passing_score' => 'required|integer|min:0|max:100',
                'status' => 'required|in:draft,aktif,selesai'
            ]);

            $data = $request->only([
                'judul',
                'deskripsi',
                'materi_id',
                'kelas_id',
                'waktu_mulai',
                'waktu_selesai',
                'durasi',
                'jumlah_soal',
                'passing_score',
                'status'
            ]);

            // Debug: Log data to be updated
            Log::info('Quiz Update Data:', $data);

            $quiz->update($data);

            return redirect()->route('guru.quiz.index')->with('success', 'Quiz berhasil diupdate!');
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Quiz $quiz)
    {
        if ($quiz->guru_id != auth()->id()) {
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
        if ($quiz->guru_id != auth()->id()) {
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
        if ($quiz->guru_id != auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'pertanyaan' => 'required|string',
            'gambar_soal' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'pertanyaan_html' => 'nullable|string',
            'tipe_soal' => 'required|in:pilihan_ganda,essay',
            'opsi_a' => 'nullable|string|required_if:tipe_soal,pilihan_ganda',
            'gambar_opsi_a' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'opsi_b' => 'nullable|string|required_if:tipe_soal,pilihan_ganda',
            'gambar_opsi_b' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'opsi_c' => 'nullable|string|required_if:tipe_soal,pilihan_ganda',
            'gambar_opsi_c' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'opsi_d' => 'nullable|string|required_if:tipe_soal,pilihan_ganda',
            'gambar_opsi_d' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'jawaban_benar' => 'nullable|string|required_if:tipe_soal,pilihan_ganda',
            'bobot_nilai' => 'required|integer|min:1|max:10',
            'urutan' => 'required|integer|min:1'
        ]);

        $data = $request->all();
        $data['quiz_id'] = $quiz->id;

        // Handle image uploads
        $imageFields = ['gambar_soal', 'gambar_opsi_a', 'gambar_opsi_b', 'gambar_opsi_c', 'gambar_opsi_d'];

        foreach ($imageFields as $field) {
            if ($request->hasFile($field) && $request->file($field)->isValid()) {
                $image = $request->file($field);
                $imageName = time() . '_' . $field . '_' . $image->getClientOriginalName();
                $imagePath = $image->storeAs('soal-images', $imageName, 'public');
                $data[$field] = $imagePath;
            }
        }

        SoalQuiz::create($data);

        return redirect()->route('guru.quiz.soal', $quiz)->with('success', 'Soal berhasil ditambahkan!');
    }

    /**
     * Destroy soal from quiz
     */
    public function destroySoal(Quiz $quiz, SoalQuiz $soal)
    {
        if ($quiz->guru_id != auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        if ($soal->quiz_id != $quiz->id) {
            abort(404, 'Soal tidak ditemukan.');
        }

        $soal->delete();
        return redirect()->route('guru.quiz.soal', $quiz)->with('success', 'Soal berhasil dihapus!');
    }
}
