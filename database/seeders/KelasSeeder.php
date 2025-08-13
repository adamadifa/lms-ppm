<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kelas;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kelas = [
            // Kelas X
            [
                'nama' => 'X-A',
                'tingkat' => 'X',
                'jurusan' => 'Umum',
                'status' => 'aktif'
            ],
            [
                'nama' => 'X-B',
                'tingkat' => 'X',
                'jurusan' => 'Umum',
                'status' => 'aktif'
            ],
            [
                'nama' => 'X-C',
                'tingkat' => 'X',
                'jurusan' => 'Umum',
                'status' => 'aktif'
            ],

            // Kelas XI
            [
                'nama' => 'XI-IPA-1',
                'tingkat' => 'XI',
                'jurusan' => 'IPA',
                'status' => 'aktif'
            ],
            [
                'nama' => 'XI-IPA-2',
                'tingkat' => 'XI',
                'jurusan' => 'IPA',
                'status' => 'aktif'
            ],
            [
                'nama' => 'XI-IPS-1',
                'tingkat' => 'XI',
                'jurusan' => 'IPS',
                'status' => 'aktif'
            ],
            [
                'nama' => 'XI-IPS-2',
                'tingkat' => 'XI',
                'jurusan' => 'IPS',
                'status' => 'aktif'
            ],

            // Kelas XII
            [
                'nama' => 'XII-IPA-1',
                'tingkat' => 'XII',
                'jurusan' => 'IPA',
                'status' => 'aktif'
            ],
            [
                'nama' => 'XII-IPA-2',
                'tingkat' => 'XII',
                'jurusan' => 'IPA',
                'status' => 'aktif'
            ],
            [
                'nama' => 'XII-IPS-1',
                'tingkat' => 'XII',
                'jurusan' => 'IPS',
                'status' => 'aktif'
            ],
            [
                'nama' => 'XII-IPS-2',
                'tingkat' => 'XII',
                'jurusan' => 'IPS',
                'status' => 'aktif'
            ]
        ];

        foreach ($kelas as $k) {
            Kelas::create($k);
        }

        $this->command->info('Kelas seeded successfully!');
    }
}
