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
        Schema::table('lembar_kerja_siswa', function (Blueprint $table) {
            // Drop foreign key constraint for kelas_id
            $table->dropForeign(['kelas_id']);

            // Drop the kelas_id column
            $table->dropColumn('kelas_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lembar_kerja_siswa', function (Blueprint $table) {
            // Add back kelas_id column
            $table->foreignId('kelas_id')->after('materi_id')->constrained('kelas')->onDelete('cascade');
        });
    }
};
