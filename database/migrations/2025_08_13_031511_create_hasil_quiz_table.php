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
        Schema::create('hasil_quiz', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quiz_id')->constrained('quiz')->onDelete('cascade');
            $table->foreignId('siswa_id')->constrained('users')->onDelete('cascade');
            $table->timestamp('waktu_mulai')->nullable();
            $table->timestamp('waktu_selesai')->nullable();
            $table->integer('nilai')->default(0);
            $table->enum('status', ['sedang_mengerjakan', 'selesai'])->default('sedang_mengerjakan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil_quiz');
    }
};
