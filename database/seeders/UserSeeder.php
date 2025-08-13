<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Admin
        $admin = User::create([
            'name' => 'Administrator',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => Hash::make('admin123'),
        ]);
        $admin->assignRole('admin');

        // Create Guru
        $guru = User::create([
            'name' => 'Guru Matematika',
            'email' => 'guru@guru.com',
            'email_verified_at' => now(),
            'password' => Hash::make('guru123'),
        ]);
        $guru->assignRole('guru');

        // Create Siswa
        $siswa = User::create([
            'name' => 'Siswa Demo',
            'email' => 'siswa@siswa.com',
            'email_verified_at' => now(),
            'password' => Hash::make('siswa123'),
        ]);
        $siswa->assignRole('siswa');

        $this->command->info('Default users created successfully!');
        $this->command->info('Admin: admin@admin.com / admin123');
        $this->command->info('Guru: guru@guru.com / guru123');
        $this->command->info('Siswa: siswa@siswa.com / siswa123');
    }
}
