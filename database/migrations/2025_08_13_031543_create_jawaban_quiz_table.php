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
        Schema::create('jawaban_quiz', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hasil_quiz_id')->constrained('hasil_quiz')->onDelete('cascade');
            $table->foreignId('soal_id')->constrained('soal_quiz')->onDelete('cascade');
            $table->text('jawaban_siswa')->nullable();
            $table->integer('nilai_per_soal')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jawaban_quiz');
    }
};
