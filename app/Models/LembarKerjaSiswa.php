<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Materi;

class LembarKerjaSiswa extends Model
{
    use HasFactory;

    protected $table = 'lembar_kerja_siswa';

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName()
    {
        return 'id';
    }

    protected $fillable = [
        'judul',
        'deskripsi',
        'instruksi',
        'file_path',
        'materi_id',
        'guru_id',
        'deadline',
        'status'
    ];

    protected $casts = [
        'deadline' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function materi()
    {
        return $this->belongsTo(Materi::class);
    }

    public function kelas()
    {
        return $this->hasOneThrough(Kelas::class, Materi::class, 'id', 'id', 'materi_id', 'kelas_id');
    }

    public function guru()
    {
        return $this->belongsTo(User::class, 'guru_id');
    }

    public function pengumpulanLKS()
    {
        return $this->hasMany(PengumpulanLKS::class, 'lks_id');
    }
}
