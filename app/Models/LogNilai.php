<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogNilai extends Model
{
    use HasFactory;

    protected $table = 'log_nilai';

    protected $fillable = [
        'siswa_id',
        'mata_pelajaran_id',
        'tipe_penilaian',
        'nilai',
        'guru_id',
        'keterangan'
    ];

    public function siswa()
    {
        return $this->belongsTo(User::class, 'siswa_id');
    }

    public function mataPelajaran()
    {
        return $this->belongsTo(MataPelajaran::class);
    }

    public function guru()
    {
        return $this->belongsTo(User::class, 'guru_id');
    }
}
