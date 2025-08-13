<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataPelajaran extends Model
{
    use HasFactory;

    protected $table = 'mata_pelajaran';

    protected $fillable = [
        'kode',
        'nama',
        'deskripsi',
        'status'
    ];

    /**
     * Relasi ke materi
     */
    public function materi()
    {
        return $this->hasMany(Materi::class);
    }

    /**
     * Relasi ke LKS
     */
    public function lembarKerjaSiswa()
    {
        return $this->hasMany(LembarKerjaSiswa::class);
    }

    /**
     * Relasi ke quiz
     */
    public function quiz()
    {
        return $this->hasMany(Quiz::class);
    }

    /**
     * Relasi ke log nilai
     */
    public function logNilai()
    {
        return $this->hasMany(LogNilai::class);
    }
}
