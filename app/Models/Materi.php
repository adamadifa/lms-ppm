<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    use HasFactory;

    protected $table = 'materi';

    protected $fillable = [
        'judul',
        'deskripsi',
        'konten',
        'file_path',
        'mata_pelajaran_id',
        'kelas_id',
        'guru_id',
        'urutan',
        'status'
    ];

    public function mataPelajaran()
    {
        return $this->belongsTo(MataPelajaran::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function guru()
    {
        return $this->belongsTo(User::class, 'guru_id');
    }

    public function lembarKerjaSiswa()
    {
        return $this->hasMany(LembarKerjaSiswa::class);
    }

    public function video()
    {
        return $this->hasMany(MateriVideo::class)->orderBy('urutan', 'asc');
    }

    public function videoAktif()
    {
        return $this->hasMany(MateriVideo::class)->aktif()->urutan();
    }

    public function quiz()
    {
        return $this->hasMany(Quiz::class);
    }
}
