<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Materi;
use App\Models\MataPelajaran;
use App\Models\Kelas;
use App\Models\LembarKerjaSiswa;
use App\Models\Quiz;
use App\Models\MateriVideo;
use Illuminate\Http\Request;

class MateriController extends Controller
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
        // Get user's class (assuming user has class_id field)
        $userKelas = auth()->user()->kelas_id ?? null;

        if ($userKelas) {
            $materi = Materi::where('kelas_id', $userKelas)
                ->where('status', 'publikasi')
                ->with(['mataPelajaran', 'kelas', 'guru'])
                ->orderBy('urutan')
                ->paginate(12);
        } else {
            // If no class assigned, show all published materials
            $materi = Materi::where('status', 'publikasi')
                ->with(['mataPelajaran', 'kelas', 'guru'])
                ->orderBy('urutan')
                ->paginate(12);
        }

        $mataPelajaran = MataPelajaran::where('status', 'aktif')->get();
        $kelas = Kelas::where('status', 'aktif')->get();

        return view('siswa.materi.index', compact('materi', 'mataPelajaran', 'kelas'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Materi $materi)
    {
        if ($materi->status !== 'publikasi') {
            abort(404, 'Materi tidak ditemukan.');
        }

        // Check if user can access this material (same class or general access)
        $userKelas = auth()->user()->kelas_id ?? null;
        if ($userKelas && $materi->kelas_id !== $userKelas) {
            abort(403, 'Anda tidak memiliki akses ke materi ini.');
        }

        // Get LKPD for this materi
        $lkpd = LembarKerjaSiswa::where('materi_id', $materi->id)
            ->where('status', 'publikasi')
            ->orderBy('created_at', 'desc')
            ->get();

        // Get Quiz for this materi
        $quiz = Quiz::where('materi_id', $materi->id)
            ->where('status', 'aktif')
            ->orderBy('created_at', 'desc')
            ->get();

        // Get Video for this materi
        $video = MateriVideo::where('materi_id', $materi->id)
            ->where('status', 'aktif')
            ->orderBy('urutan', 'asc')
            ->get();

        return view('siswa.materi.show', compact('materi', 'lkpd', 'quiz', 'video'));
    }

    /**
     * Filter materi by mata pelajaran
     */
    public function filter(Request $request)
    {
        $mataPelajaranId = $request->get('mata_pelajaran_id');
        $kelasId = $request->get('kelas_id');

        $query = Materi::where('status', 'publikasi')
            ->with(['mataPelajaran', 'kelas', 'guru']);

        if ($mataPelajaranId) {
            $query->where('mata_pelajaran_id', $mataPelajaranId);
        }

        if ($kelasId) {
            $query->where('kelas_id', $kelasId);
        }

        $materi = $query->orderBy('urutan')->paginate(12);
        $mataPelajaran = MataPelajaran::where('status', 'aktif')->get();
        $kelas = Kelas::where('status', 'aktif')->get();

        return view('siswa.materi.index', compact('materi', 'mataPelajaran', 'kelas'));
    }
}
