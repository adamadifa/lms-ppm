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
            // Drop foreign key constraint for mata_pelajaran_id
            $table->dropForeign(['mata_pelajaran_id']);

            // Drop the mata_pelajaran_id column
            $table->dropColumn('mata_pelajaran_id');

            // Add new materi_id column
            $table->foreignId('materi_id')->after('file_path')->constrained('materi')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lembar_kerja_siswa', function (Blueprint $table) {
            // Drop foreign key constraint for materi_id
            $table->dropForeign(['materi_id']);

            // Drop the materi_id column
            $table->dropColumn('materi_id');

            // Add back mata_pelajaran_id column
            $table->foreignId('mata_pelajaran_id')->after('file_path')->constrained('mata_pelajaran')->onDelete('cascade');
        });
    }
};
