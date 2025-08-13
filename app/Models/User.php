<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Relasi untuk materi yang dibuat guru
     */
    public function materi()
    {
        return $this->hasMany(Materi::class, 'guru_id');
    }

    /**
     * Relasi untuk LKS yang dibuat guru
     */
    public function lembarKerjaSiswa()
    {
        return $this->hasMany(LembarKerjaSiswa::class, 'guru_id');
    }

    /**
     * Relasi untuk quiz yang dibuat guru
     */
    public function quiz()
    {
        return $this->hasMany(Quiz::class, 'guru_id');
    }

    /**
     * Relasi untuk pengumpulan LKS siswa
     */
    public function pengumpulanLKS()
    {
        return $this->hasMany(PengumpulanLKS::class, 'siswa_id');
    }

    /**
     * Relasi untuk hasil quiz siswa
     */
    public function hasilQuiz()
    {
        return $this->hasMany(HasilQuiz::class, 'siswa_id');
    }

    /**
     * Relasi untuk log nilai yang diberikan guru
     */
    public function logNilaiDiberikan()
    {
        return $this->hasMany(LogNilai::class, 'guru_id');
    }

    /**
     * Relasi untuk log nilai siswa
     */
    public function logNilai()
    {
        return $this->hasMany(LogNilai::class, 'siswa_id');
    }
}
