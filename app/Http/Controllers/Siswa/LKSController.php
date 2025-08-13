<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\LembarKerjaSiswa;
use App\Models\PengumpulanLKS;
use Illuminate\Http\Request;

class LKSController extends Controller
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
            $lkpd = LembarKerjaSiswa::where('kelas_id', $userKelas)
                ->where('status', 'publikasi')
                ->with(['materi', 'kelas', 'guru'])
                ->orderBy('created_at', 'desc')
                ->paginate(12);
        } else {
            // If no class assigned, show all published LKPD
            $lkpd = LembarKerjaSiswa::where('status', 'publikasi')
                ->with(['materi', 'kelas', 'guru'])
                ->orderBy('created_at', 'desc')
                ->paginate(12);
        }

        return view('siswa.lks.index', compact('lkpd'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Find LKPD by ID
        $lks = LembarKerjaSiswa::findOrFail($id);

        // Check if LKPD is published
        if ($lks->status !== 'publikasi') {
            abort(404, 'LKPD tidak ditemukan.');
        }

        // Check if user can access this LKPD (same class or general access)
        $userKelas = auth()->user()->kelas_id ?? null;
        if ($userKelas && $lks->kelas_id !== $userKelas) {
            abort(403, 'Anda tidak memiliki akses ke LKPD ini.');
        }

        // Get user's submission for this LKPD
        $pengumpulan = PengumpulanLKS::where('lks_id', $lks->id)
            ->where('siswa_id', auth()->id())
            ->first();

        return view('siswa.lks.show', compact('lks', 'pengumpulan'));
    }

    /**
     * Submit LKPD answers
     */
    public function submit(Request $request, $id)
    {
        // Find LKPD by ID
        $lks = LembarKerjaSiswa::findOrFail($id);

        // Check if LKPD is published
        if ($lks->status !== 'publikasi') {
            abort(404, 'LKPD tidak ditemukan.');
        }

        // Check if user can access this LKPD
        $userKelas = auth()->user()->kelas_id ?? null;
        if ($userKelas && $lks->kelas_id !== $userKelas) {
            abort(403, 'Anda tidak memiliki akses ke LKPD ini.');
        }

        // Check if deadline has passed
        if ($lks->deadline && now()->isAfter($lks->deadline)) {
            return back()->with('error', 'Deadline LKPD sudah lewat.');
        }

        // Check if user already submitted
        $existingSubmission = PengumpulanLKS::where('lks_id', $lks->id)
            ->where('siswa_id', auth()->id())
            ->first();

        if ($existingSubmission) {
            return back()->with('error', 'Anda sudah mengumpulkan LKPD ini.');
        }

        $request->validate([
            'jawaban' => 'required|string',
            'file_jawaban' => 'nullable|file|mimes:pdf,doc,docx|max:10240'
        ]);

        $data = [
            'lks_id' => $lks->id,
            'siswa_id' => auth()->id(),
            'jawaban' => $request->jawaban,
            'waktu_pengumpulan' => now(),
            'status' => 'dikumpul'
        ];

        if ($request->hasFile('file_jawaban')) {
            $file = $request->file('file_jawaban');
            $fileName = time() . '_' . auth()->id() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/pengumpulan-lks', $fileName);
            $data['file_jawaban'] = 'pengumpulan-lks/' . $fileName;
        }

        PengumpulanLKS::create($data);

        return redirect()->route('siswa.lks.show', $lks->id)->with('success', 'LKPD berhasil dikumpulkan!');
    }
}
