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
        Schema::create('pengumpulan_lks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lks_id')->constrained('lembar_kerja_siswa')->onDelete('cascade');
            $table->foreignId('siswa_id')->constrained('users')->onDelete('cascade');
            $table->string('file_path')->nullable();
            $table->text('komentar')->nullable();
            $table->enum('status', ['belum_dikumpul', 'dikumpul', 'dinilai'])->default('belum_dikumpul');
            $table->integer('nilai')->nullable();
            $table->text('feedback')->nullable();
            $table->timestamp('submitted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengumpulan_lks');
    }
};
