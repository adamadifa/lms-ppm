<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $table = 'quiz';

    protected $fillable = [
        'judul',
        'deskripsi',
        'materi_id',
        'kelas_id',
        'guru_id',
        'waktu_mulai',
        'waktu_selesai',
        'durasi',
        'jumlah_soal',
        'passing_score',
        'status'
    ];

    public function materi()
    {
        return $this->belongsTo(Materi::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function guru()
    {
        return $this->belongsTo(User::class, 'guru_id');
    }

    public function soalQuiz()
    {
        return $this->hasMany(SoalQuiz::class);
    }

    public function hasilQuiz()
    {
        return $this->hasMany(HasilQuiz::class);
    }
}
