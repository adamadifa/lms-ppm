<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\HasilQuiz;
use App\Models\PengumpulanLKS;
use App\Models\Materi;
use App\Models\LembarKerjaSiswa;
use App\Models\Quiz;

class NilaiController extends Controller
{
    /**
     * Display a listing of the student's grades
     */
    public function index()
    {
        $user = auth()->user();

        try {
            // Get quiz results
            $hasilQuiz = HasilQuiz::where('siswa_id', $user->id)
                ->with(['quiz.materi'])
                ->orderBy('created_at', 'desc')
                ->get();

            // Get LKPD submissions
            $pengumpulanLKS = PengumpulanLKS::where('siswa_id', $user->id)
                ->with(['lembarKerjaSiswa.materi'])
                ->orderBy('created_at', 'desc')
                ->get();

            // Get materials that have LKPD or Quiz submissions
            $materiIds = collect();

            // Get materi IDs from LKPD submissions
            $materiIds = $materiIds->merge(
                $pengumpulanLKS->pluck('lembarKerjaSiswa.materi.id')->filter()
            );

            // Get materi IDs from Quiz results
            $materiIds = $materiIds->merge(
                $hasilQuiz->pluck('quiz.materi.id')->filter()
            );

            // Get unique materi IDs
            $materiIds = $materiIds->unique();

            // Get materials
            $materi = Materi::whereIn('id', $materiIds)->get();

            return view('siswa.nilai.index', compact('hasilQuiz', 'pengumpulanLKS', 'materi'));
        } catch (\Exception $e) {
            // Log error for debugging
            Log::error('Error in NilaiController@index: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());

            // Return error view or redirect with error message
            return back()->with('error', 'Terjadi kesalahan saat memuat data nilai: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified grade detail
     */
    public function show($id)
    {
        $user = auth()->user();

        try {
            // Try to find quiz result first
            $hasilQuiz = HasilQuiz::where('id', $id)
                ->where('siswa_id', $user->id)
                ->with(['quiz.materi', 'quiz.soalQuiz'])
                ->first();

            if ($hasilQuiz) {
                return view('siswa.nilai.show_quiz', compact('hasilQuiz'));
            }

            // Try to find LKPD submission
            $pengumpulanLKS = PengumpulanLKS::where('id', $id)
                ->where('siswa_id', $user->id)
                ->with(['lembarKerjaSiswa.materi'])
                ->first();

            if ($pengumpulanLKS) {
                return view('siswa.nilai.show_lks', compact('pengumpulanLKS'));
            }

            abort(404, 'Nilai tidak ditemukan.');
        } catch (\Exception $e) {
            // Log error for debugging
            Log::error('Error in NilaiController@show: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());

            // Return error view or redirect with error message
            return back()->with('error', 'Terjadi kesalahan saat memuat detail nilai: ' . $e->getMessage());
        }
    }

    /**
     * Display quiz result detail
     */
    public function showQuiz($id)
    {
        $user = auth()->user();

        try {
            $hasilQuiz = HasilQuiz::where('id', $id)
                ->where('siswa_id', $user->id)
                ->with(['quiz.materi', 'quiz.soalQuiz'])
                ->first();

            if (!$hasilQuiz) {
                abort(404, 'Hasil quiz tidak ditemukan.');
            }

            return view('siswa.nilai.show_quiz', compact('hasilQuiz'));
        } catch (\Exception $e) {
            Log::error('Error in NilaiController@showQuiz: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat memuat detail quiz: ' . $e->getMessage());
        }
    }

    /**
     * Display LKPD submission detail
     */
    public function showLKS($id)
    {
        $user = auth()->user();

        try {
            $pengumpulanLKS = PengumpulanLKS::where('id', $id)
                ->where('siswa_id', $user->id)
                ->with(['lembarKerjaSiswa.materi'])
                ->first();

            if (!$pengumpulanLKS) {
                abort(404, 'Pengumpulan LKPD tidak ditemukan.');
            }

            return view('siswa.nilai.show_lks', compact('pengumpulanLKS'));
        } catch (\Exception $e) {
            Log::error('Error in NilaiController@showLKS: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat memuat detail LKPD: ' . $e->getMessage());
        }
    }
}
