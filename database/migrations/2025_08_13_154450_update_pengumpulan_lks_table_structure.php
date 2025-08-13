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
        Schema::table('pengumpulan_lks', function (Blueprint $table) {
            // Drop existing columns that are not needed
            $table->dropColumn(['komentar', 'submitted_at']);

            // Add new columns that are needed
            $table->text('jawaban')->after('siswa_id');
            $table->string('file_jawaban')->nullable()->after('jawaban');
            $table->timestamp('waktu_pengumpulan')->nullable()->after('file_jawaban');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengumpulan_lks', function (Blueprint $table) {
            // Restore original columns
            $table->text('komentar')->nullable();
            $table->timestamp('submitted_at')->nullable();

            // Drop new columns
            $table->dropColumn(['jawaban', 'file_jawaban', 'waktu_pengumpulan']);
        });
    }
};
