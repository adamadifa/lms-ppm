<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JawabanQuiz extends Model
{
    use HasFactory;

    protected $table = 'jawaban_quiz';

    protected $fillable = [
        'hasil_quiz_id',
        'soal_id',
        'jawaban_siswa',
        'kunci_jawaban',
        'benar',
        'nilai_per_soal'
    ];

    public function hasilQuiz()
    {
        return $this->belongsTo(HasilQuiz::class);
    }

    public function soal()
    {
        return $this->belongsTo(SoalQuiz::class);
    }
}
