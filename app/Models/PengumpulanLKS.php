<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengumpulanLKS extends Model
{
    use HasFactory;

    protected $table = 'pengumpulan_lks';

    protected $fillable = [
        'lks_id',
        'siswa_id',
        'file_path',
        'komentar',
        'status',
        'nilai',
        'feedback',
        'submitted_at'
    ];

    public function lks()
    {
        return $this->belongsTo(LembarKerjaSiswa::class, 'lks_id');
    }

    public function siswa()
    {
        return $this->belongsTo(User::class, 'siswa_id');
    }
}
