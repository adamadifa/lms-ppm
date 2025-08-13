<?php

namespace Database\Seeders;

use App\Models\LembarKerjaSiswa;
use App\Models\User;
use App\Models\Materi;
use App\Models\Kelas;
use Illuminate\Database\Seeder;

class LembarKerjaSiswaSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        // Get guru user (assuming guru role exists)
        $guru = User::whereHas('roles', function ($query) {
            $query->where('name', 'guru');
        })->first();

        if (!$guru) {
            $this->command->warn('No guru user found. Please run UserSeeder first.');
            return;
        }

        // Get materi
        $materi = Materi::first(); // Get first available materi

        if (!$materi) {
            $this->command->warn('Materi not found. Please run seeders first.');
            return;
        }

        // Create sample LKS
        $lksData = [
            [
                'judul' => 'LKS Aljabar Dasar',
                'deskripsi' => 'Lembar kerja siswa untuk mempelajari konsep dasar aljabar',
                'instruksi' => 'Kerjakan semua soal dengan langkah-langkah yang jelas. Waktu pengerjaan 90 menit.',
                'materi_id' => $materi->id,
                'guru_id' => $guru->id,
                'deadline' => now()->addDays(7),
                'status' => 'publikasi'
            ],
            [
                'judul' => 'LKS Geometri Bidang',
                'deskripsi' => 'Latihan soal tentang geometri bidang dan bangun datar',
                'instruksi' => 'Gambar dan hitung luas serta keliling bangun datar yang diberikan.',
                'materi_id' => $materi->id,
                'guru_id' => $guru->id,
                'deadline' => now()->addDays(5),
                'status' => 'draft'
            ],
            [
                'judul' => 'LKS Trigonometri',
                'deskripsi' => 'Penerapan rumus trigonometri dalam berbagai kasus',
                'instruksi' => 'Gunakan kalkulator scientific untuk perhitungan. Bulatkan hasil ke 2 desimal.',
                'materi_id' => $materi->id,
                'guru_id' => $guru->id,
                'deadline' => now()->addDays(10),
                'status' => 'publikasi'
            ]
        ];

        foreach ($lksData as $data) {
            LembarKerjaSiswa::create($data);
        }

        $this->command->info('LKS sample data created successfully!');
        $this->command->info('Created 3 LKS for guru: ' . $guru->name);
    }
}
