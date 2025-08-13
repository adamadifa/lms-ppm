<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MataPelajaran;
use Illuminate\Http\Request;

class MataPelajaranController extends Controller
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
        $mataPelajaran = MataPelajaran::paginate(10);
        return view('admin.mata-pelajaran.index', compact('mataPelajaran'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.mata-pelajaran.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|string|max:10|unique:mata_pelajaran',
            'nama' => 'required|string|max:100',
            'deskripsi' => 'nullable|string',
            'status' => 'required|in:aktif,nonaktif'
        ]);

        MataPelajaran::create($request->all());

        return redirect()->route('admin.mata-pelajaran.index')->with('success', 'Mata pelajaran berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(MataPelajaran $mataPelajaran)
    {
        return view('admin.mata-pelajaran.show', compact('mataPelajaran'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MataPelajaran $mataPelajaran)
    {
        return view('admin.mata-pelajaran.edit', compact('mataPelajaran'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MataPelajaran $mataPelajaran)
    {
        $request->validate([
            'kode' => 'required|string|max:10|unique:mata_pelajaran,kode,' . $mataPelajaran->id,
            'nama' => 'required|string|max:100',
            'deskripsi' => 'nullable|string',
            'status' => 'required|in:aktif,nonaktif'
        ]);

        $mataPelajaran->update($request->all());

        return redirect()->route('admin.mata-pelajaran.index')->with('success', 'Mata pelajaran berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MataPelajaran $mataPelajaran)
    {
        // Check if mata pelajaran is being used
        if (
            $mataPelajaran->materi()->count() > 0 ||
            $mataPelajaran->lembarKerjaSiswa()->count() > 0 ||
            $mataPelajaran->quiz()->count() > 0
        ) {
            return redirect()->route('admin.mata-pelajaran.index')->with('error', 'Mata pelajaran tidak bisa dihapus karena masih digunakan!');
        }

        $mataPelajaran->delete();
        return redirect()->route('admin.mata-pelajaran.index')->with('success', 'Mata pelajaran berhasil dihapus!');
    }
}
