<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilQuiz extends Model
{
    use HasFactory;

    protected $table = 'hasil_quiz';

    protected $fillable = [
        'quiz_id',
        'siswa_id',
        'waktu_mulai',
        'waktu_selesai',
        'nilai',
        'status'
    ];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    public function siswa()
    {
        return $this->belongsTo(User::class, 'siswa_id');
    }
}
