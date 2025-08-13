<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lembar_kerja_siswa', function (Blueprint $table) {
            $table->id();
            $table->string('judul', 200);
            $table->text('deskripsi')->nullable();
            $table->text('instruksi')->nullable();
            $table->string('file_path')->nullable();
            $table->foreignId('mata_pelajaran_id')->constrained('mata_pelajaran')->onDelete('cascade');
            $table->foreignId('kelas_id')->constrained('kelas')->onDelete('cascade');
            $table->foreignId('guru_id')->constrained('users')->onDelete('cascade');
            $table->timestamp('deadline')->nullable();
            $table->enum('status', ['draft', 'publikasi'])->default('draft');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lembar_kerja_siswa');
    }
};
