<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Materi;
use App\Models\MataPelajaran;
use App\Models\Kelas;
use App\Models\LembarKerjaSiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class MateriController extends Controller
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
        $materi = Materi::where('guru_id', auth()->id())
            ->with(['mataPelajaran', 'kelas'])
            ->paginate(10);
        return view('guru.materi.index', compact('materi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $mataPelajaran = MataPelajaran::where('status', 'aktif')->get();
        $kelas = Kelas::where('status', 'aktif')->get();
        return view('guru.materi.create', compact('mataPelajaran', 'kelas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:200',
            'deskripsi' => 'nullable|string',
            'konten' => 'required|string',
            'file_path' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx|max:10240',
            'mata_pelajaran_id' => 'required|exists:mata_pelajaran,id',
            'kelas_id' => 'required|exists:kelas,id',
            'urutan' => 'required|integer|min:1',
            'status' => 'required|in:draft,publikasi'
        ]);

        $data = $request->all();
        $data['guru_id'] = auth()->id();

        if ($request->hasFile('file_path')) {
            $file = $request->file('file_path');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/materi', $fileName);
            $data['file_path'] = 'materi/' . $fileName;
        }

        Materi::create($data);

        return redirect()->route('guru.materi.index')->with('success', 'Materi berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Materi $materi)
    {
        // Debug information
        \Log::info('Materi Show Debug', [
            'materi_id' => $materi->id,
            'materi_guru_id' => $materi->guru_id,
            'auth_user_id' => auth()->id(),
            'auth_user_roles' => auth()->user()->getRoleNames()->toArray(),
            'materi_exists' => $materi->exists,
        ]);

        if ($materi->guru_id != auth()->id()) {
            \Log::error('Unauthorized access to materi', [
                'materi_id' => $materi->id,
                'materi_guru_id' => $materi->id,
                'auth_user_id' => auth()->id(),
                'guru_id_type' => gettype($materi->guru_id),
                'auth_id_type' => gettype(auth()->id()),
            ]);
            abort(403, 'Unauthorized action. Materi ID: ' . $materi->id . ', Guru ID: ' . $materi->guru_id . ', Auth User ID: ' . auth()->id());
        }

        // Get LKS related to this materi
        $lks = $materi->lembarKerjaSiswa()->orderBy('created_at', 'desc')->get();

        // Get videos related to this materi
        $videos = $materi->videoAktif()->get();

        return view('guru.materi.show', compact('materi', 'lks', 'videos'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Materi $materi)
    {
        if ($materi->guru_id != auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $mataPelajaran = MataPelajaran::where('status', 'aktif')->get();
        $kelas = Kelas::where('status', 'aktif')->get();
        return view('guru.materi.edit', compact('materi', 'mataPelajaran', 'kelas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Materi $materi)
    {
        if ($materi->guru_id != auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'judul' => 'required|string|max:200',
            'deskripsi' => 'nullable|string',
            'konten' => 'required|string',
            'file_path' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx|max:10240',
            'mata_pelajaran_id' => 'required|exists:mata_pelajaran,id',
            'kelas_id' => 'required|exists:kelas,id',
            'urutan' => 'required|integer|min:1',
            'status' => 'required|in:draft,publikasi'
        ]);

        $data = $request->all();

        if ($request->hasFile('file_path')) {
            // Delete old file if exists
            if ($materi->file_path) {
                Storage::delete('public/' . $materi->file_path);
            }

            $file = $request->file('file_path');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/materi', $fileName);
            $data['file_path'] = 'materi/' . $fileName;
        }

        $materi->update($data);

        return redirect()->route('guru.materi.index')->with('success', 'Materi berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Materi $materi)
    {
        if ($materi->guru_id != auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        // Delete file if exists
        if ($materi->file_path) {
            Storage::delete('public/' . $materi->file_path);
        }

        $materi->delete();
        return redirect()->route('guru.materi.index')->with('success', 'Materi berhasil dihapus!');
    }
}
