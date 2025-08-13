<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Drop the existing enum column
        Schema::table('hasil_quiz', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        // Add the new enum column with updated values
        Schema::table('hasil_quiz', function (Blueprint $table) {
            $table->enum('status', ['sedang_mengerjakan', 'selesai', 'lulus', 'tidak_lulus'])->default('sedang_mengerjakan')->after('total_soal');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Drop the new enum column
        Schema::table('hasil_quiz', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        // Add back the original enum column
        Schema::table('hasil_quiz', function (Blueprint $table) {
            $table->enum('status', ['sedang_mengerjakan', 'selesai'])->default('sedang_mengerjakan')->after('total_soal');
        });
    }
};
