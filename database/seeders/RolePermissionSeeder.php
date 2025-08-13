<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            // User management
            'user.view',
            'user.create',
            'user.edit',
            'user.delete',

            // Mata pelajaran management
            'mata-pelajaran.view',
            'mata-pelajaran.create',
            'mata-pelajaran.edit',
            'mata-pelajaran.delete',

            // Kelas management
            'kelas.view',
            'kelas.create',
            'kelas.edit',
            'kelas.delete',

            // Materi management
            'materi.view',
            'materi.create',
            'materi.edit',
            'materi.delete',

            // LKS management
            'lks.view',
            'lks.create',
            'lks.edit',
            'lks.delete',

            // Quiz management
            'quiz.view',
            'quiz.create',
            'quiz.edit',
            'quiz.delete',

            // Nilai management
            'nilai.view',
            'nilai.create',
            'nilai.edit',
            'nilai.delete',

            // Monitoring
            'monitoring.view',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create roles and assign permissions
        $adminRole = Role::create(['name' => 'admin']);
        $guruRole = Role::create(['name' => 'guru']);
        $siswaRole = Role::create(['name' => 'siswa']);

        // Admin gets all permissions
        $adminRole->givePermissionTo(Permission::all());

        // Guru permissions
        $guruRole->givePermissionTo([
            'materi.view',
            'materi.create',
            'materi.edit',
            'materi.delete',
            'lks.view',
            'lks.create',
            'lks.edit',
            'lks.delete',
            'quiz.view',
            'quiz.create',
            'quiz.edit',
            'quiz.delete',
            'nilai.view',
            'nilai.create',
            'nilai.edit',
            'nilai.delete',
        ]);

        // Siswa permissions
        $siswaRole->givePermissionTo([
            'materi.view',
            'lks.view',
            'quiz.view',
            'nilai.view',
        ]);

        $this->command->info('Roles and permissions created successfully!');
    }
}
