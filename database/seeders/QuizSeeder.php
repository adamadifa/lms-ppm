<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Quiz;
use App\Models\Materi;
use App\Models\Kelas;
use App\Models\User;

class QuizSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Get first materi and kelas
        $materi = Materi::first();
        $kelas = Kelas::first();
        $guru = User::role('guru')->first();

        if (!$materi || !$kelas || !$guru) {
            $this->command->warn('Materi, kelas, atau guru tidak ditemukan. Silakan jalankan seeder lain terlebih dahulu.');
            return;
        }

        // Sample quiz data
        $quizzes = [
            [
                'judul' => 'Quiz Aljabar Dasar',
                'deskripsi' => 'Quiz untuk menguji pemahaman konsep dasar aljabar',
                'materi_id' => $materi->id,
                'kelas_id' => $kelas->id,
                'guru_id' => $guru->id,
                'waktu_mulai' => now(),
                'waktu_selesai' => now()->addDays(7),
                'durasi' => 60,
                'jumlah_soal' => 20,
                'passing_score' => 70,
                'status' => 'aktif'
            ],
            [
                'judul' => 'Quiz Persamaan Linear',
                'deskripsi' => 'Quiz tentang persamaan linear satu variabel',
                'materi_id' => $materi->id,
                'kelas_id' => $kelas->id,
                'guru_id' => $guru->id,
                'waktu_mulai' => now()->addDays(1),
                'waktu_selesai' => now()->addDays(14),
                'durasi' => 45,
                'jumlah_soal' => 15,
                'passing_score' => 75,
                'status' => 'draft'
            ],
            [
                'judul' => 'Quiz Fungsi Kuadrat',
                'deskripsi' => 'Quiz untuk menguji pemahaman fungsi kuadrat',
                'materi_id' => $materi->id,
                'kelas_id' => $kelas->id,
                'guru_id' => $guru->id,
                'waktu_mulai' => now()->addDays(2),
                'waktu_selesai' => now()->addDays(21),
                'durasi' => 90,
                'jumlah_soal' => 25,
                'passing_score' => 80,
                'status' => 'draft'
            ]
        ];

        foreach ($quizzes as $quizData) {
            Quiz::create($quizData);
        }

        $this->command->info('Quiz berhasil dibuat!');
    }
}
