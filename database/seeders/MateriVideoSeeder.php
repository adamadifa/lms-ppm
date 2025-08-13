<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Materi;
use App\Models\MateriVideo;

class MateriVideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Get first materi
        $materi = Materi::first();

        if (!$materi) {
            $this->command->warn('Materi tidak ditemukan. Silakan jalankan MateriSeeder terlebih dahulu.');
            return;
        }

        // Sample video data
        $videos = [
            [
                'judul' => 'Pengenalan Aljabar - Bagian 1',
                'deskripsi' => 'Video pengenalan konsep dasar aljabar untuk pemula',
                'youtube_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'urutan' => 1,
                'status' => 'aktif'
            ],
            [
                'judul' => 'Pengenalan Aljabar - Bagian 2',
                'deskripsi' => 'Lanjutan pembahasan aljabar dengan contoh soal',
                'youtube_url' => 'https://www.youtube.com/watch?v=9bZkp7q19f0',
                'urutan' => 2,
                'status' => 'aktif'
            ],
            [
                'judul' => 'Latihan Soal Aljabar',
                'deskripsi' => 'Video berisi latihan soal dan pembahasan aljabar',
                'youtube_url' => 'https://www.youtube.com/watch?v=oHg5SJYRHA0',
                'urutan' => 3,
                'status' => 'aktif'
            ]
        ];

        foreach ($videos as $videoData) {
            MateriVideo::create([
                'materi_id' => $materi->id,
                'judul' => $videoData['judul'],
                'deskripsi' => $videoData['deskripsi'],
                'youtube_url' => $videoData['youtube_url'],
                'urutan' => $videoData['urutan'],
                'status' => $videoData['status']
            ]);
        }

        $this->command->info('MateriVideo berhasil dibuat!');
    }
}
