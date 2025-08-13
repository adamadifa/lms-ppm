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
        'jawaban',
        'file_jawaban',
        'waktu_pengumpulan',
        'status',
        'nilai',
        'feedback'
    ];

    protected $casts = [
        'waktu_pengumpulan' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function lks()
    {
        return $this->belongsTo(LembarKerjaSiswa::class, 'lks_id');
    }

    // Alias for backward compatibility
    public function lembarKerjaSiswa()
    {
        return $this->belongsTo(LembarKerjaSiswa::class, 'lks_id');
    }

    public function siswa()
    {
        return $this->belongsTo(User::class, 'siswa_id');
    }

    public function nilai()
    {
        return $this->hasOne(LogNilai::class, 'pengumpulan_lks_id');
    }
}
