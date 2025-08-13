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
            // Drop the existing column
            $table->dropColumn('waktu_pengumpulan');
        });

        Schema::table('pengumpulan_lks', function (Blueprint $table) {
            // Add the column back as timestamp
            $table->timestamp('waktu_pengumpulan')->nullable()->after('file_jawaban');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengumpulan_lks', function (Blueprint $table) {
            // Drop the timestamp column
            $table->dropColumn('waktu_pengumpulan');
        });

        Schema::table('pengumpulan_lks', function (Blueprint $table) {
            // Add back as string
            $table->string('waktu_pengumpulan')->nullable()->after('file_jawaban');
        });
    }
};
