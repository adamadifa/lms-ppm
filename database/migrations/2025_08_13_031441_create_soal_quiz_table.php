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
        Schema::create('soal_quiz', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quiz_id')->constrained('quiz')->onDelete('cascade');
            $table->text('pertanyaan');
            $table->enum('tipe_soal', ['pilihan_ganda', 'essay'])->default('pilihan_ganda');
            $table->string('opsi_a')->nullable();
            $table->string('opsi_b')->nullable();
            $table->string('opsi_c')->nullable();
            $table->string('opsi_d')->nullable();
            $table->string('jawaban_benar')->nullable();
            $table->integer('bobot_nilai')->default(1);
            $table->integer('urutan')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('soal_quiz');
    }
};
