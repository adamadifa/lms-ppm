<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Materi;
use App\Models\MateriVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MateriVideoController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:guru');
    }

    /**
     * Validasi YouTube URL
     */
    private function validateYouTubeUrl($url)
    {
        return preg_match('/^(https?:\/\/)?(www\.)?(youtube\.com\/watch\?v=|youtu\.be\/)[a-zA-Z0-9_-]+/', $url);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $videos = MateriVideo::with(['materi.mataPelajaran', 'materi.kelas'])
            ->whereHas('materi', function ($query) {
                $query->where('guru_id', auth()->id());
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('guru.materi-video.index', compact('videos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $materi = Materi::where('guru_id', auth()->id())
            ->where('status', 'publikasi')
            ->get();

        return view('guru.materi-video.create', compact('materi'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'materi_id' => 'required|exists:materi,id',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'youtube_url' => 'required|url',
            'urutan' => 'nullable|integer|min:1',
            'status' => 'required|in:aktif,nonaktif'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Cek apakah materi milik guru yang login
        $materi = Materi::where('id', $request->materi_id)
            ->where('guru_id', auth()->id())
            ->first();

        if (!$materi) {
            abort(403, 'Unauthorized action.');
        }

        // Jika urutan tidak diisi, ambil urutan terakhir + 1
        $urutan = $request->urutan;
        if (!$urutan) {
            $lastOrder = MateriVideo::where('materi_id', $request->materi_id)
                ->max('urutan');
            $urutan = $lastOrder ? $lastOrder + 1 : 1;
        }

        // Parse YouTube URL untuk mendapatkan video ID
        $youtubeId = null;
        if (preg_match('/youtube\.com\/watch\?v=([^&]+)/', $request->youtube_url, $matches)) {
            $youtubeId = $matches[1];
        } elseif (preg_match('/youtu\.be\/([^?]+)/', $request->youtube_url, $matches)) {
            $youtubeId = $matches[1];
        }

        MateriVideo::create([
            'materi_id' => $request->materi_id,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'youtube_url' => $request->youtube_url,
            'youtube_id' => $youtubeId,
            'urutan' => $urutan,
            'status' => $request->status
        ]);

        return redirect()->route('guru.materi-video.index')
            ->with('success', 'Video berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(MateriVideo $materiVideo)
    {
        if ($materiVideo->materi->guru_id != auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('guru.materi-video.show', compact('materiVideo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MateriVideo $materiVideo)
    {
        if ($materiVideo->materi->guru_id != auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $materi = Materi::where('guru_id', auth()->id())
            ->where('status', 'publikasi')
            ->get();

        return view('guru.materi-video.edit', compact('materiVideo', 'materi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MateriVideo $materiVideo)
    {
        if ($materiVideo->materi->guru_id != auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $validator = Validator::make($request->all(), [
            'materi_id' => 'required|exists:materi,id',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'youtube_url' => 'required|url',
            'urutan' => 'nullable|integer|min:1',
            'status' => 'required|in:aktif,nonaktif'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Cek apakah materi milik guru yang login
        $materi = Materi::where('id', $request->materi_id)
            ->where('guru_id', auth()->id())
            ->first();

        if (!$materi) {
            abort(403, 'Unauthorized action.');
        }

        // Parse YouTube URL untuk mendapatkan video ID
        $youtubeId = null;
        if (preg_match('/youtube\.com\/watch\?v=([^&]+)/', $request->youtube_url, $matches)) {
            $youtubeId = $matches[1];
        } elseif (preg_match('/youtu\.be\/([^?]+)/', $request->youtube_url, $matches)) {
            $youtubeId = $matches[1];
        }

        $materiVideo->update([
            'materi_id' => $request->materi_id,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'youtube_url' => $request->youtube_url,
            'youtube_id' => $youtubeId,
            'urutan' => $request->urutan,
            'status' => $request->status
        ]);

        return redirect()->route('guru.materi-video.index')
            ->with('success', 'Video berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MateriVideo $materiVideo)
    {
        if ($materiVideo->materi->guru_id != auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $materiVideo->delete();

        return redirect()->route('guru.materi-video.index')
            ->with('success', 'Video berhasil dihapus!');
    }

    /**
     * Tampilkan video untuk materi tertentu
     */
    public function showByMateri(Materi $materi)
    {
        if ($materi->guru_id != auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $videos = $materi->videoAktif()->get();

        return view('guru.materi-video.show-by-materi', compact('materi', 'videos'));
    }
}
