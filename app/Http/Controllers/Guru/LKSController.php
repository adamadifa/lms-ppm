<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\LembarKerjaSiswa;
use App\Models\Materi;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LKSController extends Controller
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
        $lks = LembarKerjaSiswa::where('guru_id', auth()->id())
            ->with(['materi', 'kelas'])
            ->paginate(10);
        return view('guru.lks.index', compact('lks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $materi = Materi::all(); // Get all available materi
        return view('guru.lks.create', compact('materi'));
    }

    /**
     * Show the form for creating a new LKS from specific materi.
     */
    public function createFromMateri(Materi $materi)
    {
        // Check if guru owns this materi
        if ($materi->guru_id != auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('guru.lks.create', compact('materi'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:200',
            'deskripsi' => 'nullable|string',
            'instruksi' => 'nullable|string',
            'file_path' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
            'materi_id' => 'required|exists:materi,id',
            'deadline' => 'nullable|date|after:today',
            'status' => 'required|in:draft,publikasi'
        ]);

        $data = $request->all();
        $data['guru_id'] = auth()->id();

        // Handle deadline format
        if ($request->filled('deadline')) {
            $data['deadline'] = \Carbon\Carbon::parse($request->deadline);
        }

        if ($request->hasFile('file_path')) {
            $file = $request->file('file_path');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/lks', $fileName);
            $data['file_path'] = 'lks/' . $fileName;
        }

        LembarKerjaSiswa::create($data);

        return redirect()->route('guru.lks.index')->with('success', 'LKS berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(LembarKerjaSiswa $lks)
    {
        if ($lks->guru_id != auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $pengumpulan = $lks->pengumpulanLKS()->with('siswa')->get();
        return view('guru.lks.show', compact('lks', 'pengumpulan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LembarKerjaSiswa $lks)
    {
        if ($lks->guru_id != auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $materi = Materi::all(); // Get all available materi
        return view('guru.lks.edit', compact('lks', 'materi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LembarKerjaSiswa $lks)
    {
        if ($lks->guru_id != auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'judul' => 'required|string|max:200',
            'deskripsi' => 'nullable|string',
            'instruksi' => 'nullable|string',
            'file_path' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
            'materi_id' => 'required|exists:materi,id',
            'deadline' => 'nullable|date|after:today',
            'status' => 'required|in:draft,publikasi'
        ]);

        $data = $request->all();

        // Handle deadline format
        if ($request->filled('deadline')) {
            $data['deadline'] = \Carbon\Carbon::parse($request->deadline);
        }

        if ($request->hasFile('file_path')) {
            // Delete old file if exists
            if ($lks->file_path) {
                Storage::delete('public/' . $lks->file_path);
            }

            $file = $request->file('file_path');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/lks', $fileName);
            $data['file_path'] = 'lks/' . $fileName;
        }

        $lks->update($data);

        return redirect()->route('guru.lks.index')->with('success', 'LKS berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LembarKerjaSiswa $lks)
    {
        if ($lks->guru_id != auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        // Delete file if exists
        if ($lks->file_path) {
            Storage::delete('public/' . $lks->file_path);
        }

        $lks->delete();
        return redirect()->route('guru.lks.index')->with('success', 'LKS berhasil dihapus!');
    }
}
