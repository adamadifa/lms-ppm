<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MataPelajaran;

class MataPelajaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mataPelajaran = [
            [
                'kode' => 'MTK',
                'nama' => 'Matematika',
                'deskripsi' => 'Mata pelajaran matematika untuk semua tingkat',
                'status' => 'aktif'
            ],
            [
                'kode' => 'BIN',
                'nama' => 'Bahasa Indonesia',
                'deskripsi' => 'Mata pelajaran bahasa Indonesia',
                'status' => 'aktif'
            ],
            [
                'kode' => 'BIG',
                'nama' => 'Bahasa Inggris',
                'deskripsi' => 'Mata pelajaran bahasa Inggris',
                'status' => 'aktif'
            ],
            [
                'kode' => 'IPA',
                'nama' => 'Ilmu Pengetahuan Alam',
                'deskripsi' => 'Mata pelajaran IPA (Fisika, Kimia, Biologi)',
                'status' => 'aktif'
            ],
            [
                'kode' => 'IPS',
                'nama' => 'Ilmu Pengetahuan Sosial',
                'deskripsi' => 'Mata pelajaran IPS (Sejarah, Geografi, Ekonomi)',
                'status' => 'aktif'
            ],
            [
                'kode' => 'PAI',
                'nama' => 'Pendidikan Agama Islam',
                'deskripsi' => 'Mata pelajaran pendidikan agama Islam',
                'status' => 'aktif'
            ],
            [
                'kode' => 'PKN',
                'nama' => 'Pendidikan Kewarganegaraan',
                'deskripsi' => 'Mata pelajaran pendidikan kewarganegaraan',
                'status' => 'aktif'
            ],
            [
                'kode' => 'SEN',
                'nama' => 'Seni Budaya',
                'deskripsi' => 'Mata pelajaran seni budaya dan keterampilan',
                'status' => 'aktif'
            ],
            [
                'kode' => 'PJK',
                'nama' => 'Pendidikan Jasmani',
                'deskripsi' => 'Mata pelajaran pendidikan jasmani dan kesehatan',
                'status' => 'aktif'
            ],
            [
                'kode' => 'INF',
                'nama' => 'Informatika',
                'deskripsi' => 'Mata pelajaran teknologi informasi dan komunikasi',
                'status' => 'aktif'
            ]
        ];

        foreach ($mataPelajaran as $mp) {
            MataPelajaran::create($mp);
        }

        $this->command->info('Mata pelajaran seeded successfully!');
    }
}
