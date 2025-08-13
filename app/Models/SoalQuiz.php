<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoalQuiz extends Model
{
    use HasFactory;

    protected $table = 'soal_quiz';

    protected $fillable = [
        'quiz_id',
        'pertanyaan',
        'gambar_soal',
        'pertanyaan_html',
        'tipe_soal',
        'opsi_a',
        'gambar_opsi_a',
        'opsi_b',
        'gambar_opsi_b',
        'opsi_c',
        'gambar_opsi_c',
        'opsi_d',
        'gambar_opsi_d',
        'jawaban_benar',
        'bobot_nilai',
        'urutan'
    ];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }
}
