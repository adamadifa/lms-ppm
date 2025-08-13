<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kelas = Kelas::paginate(10);
        return view('admin.kelas.index', compact('kelas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.kelas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:50',
            'tingkat' => 'required|in:X,XI,XII',
            'jurusan' => 'nullable|string|max:50',
            'status' => 'required|in:aktif,nonaktif'
        ]);

        Kelas::create($request->all());

        return redirect()->route('admin.kelas.index')->with('success', 'Kelas berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kelas $kelas)
    {
        return view('admin.kelas.show', compact('kelas'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kelas $kelas)
    {
        return view('admin.kelas.edit', compact('kelas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kelas $kelas)
    {
        $request->validate([
            'nama' => 'required|string|max:50',
            'tingkat' => 'required|in:X,XI,XII',
            'jurusan' => 'nullable|string|max:50',
            'status' => 'required|in:aktif,nonaktif'
        ]);

        $kelas->update($request->all());

        return redirect()->route('admin.kelas.index')->with('success', 'Kelas berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kelas $kelas)
    {
        // Check if kelas is being used
        if (
            $kelas->materi()->count() > 0 ||
            $kelas->lembarKerjaSiswa()->count() > 0 ||
            $kelas->quiz()->count() > 0
        ) {
            return redirect()->route('admin.kelas.index')->with('error', 'Kelas tidak bisa dihapus karena masih digunakan!');
        }

        $kelas->delete();
        return redirect()->route('admin.kelas.index')->with('success', 'Kelas berhasil dihapus!');
    }
}
