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
        'tipe_soal',
        'opsi_a',
        'opsi_b',
        'opsi_c',
        'opsi_d',
        'jawaban_benar',
        'bobot_nilai',
        'urutan'
    ];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }
}
