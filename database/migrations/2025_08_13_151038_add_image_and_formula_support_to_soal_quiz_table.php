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
        Schema::table('soal_quiz', function (Blueprint $table) {
            $table->string('gambar_soal')->nullable()->after('pertanyaan');
            $table->text('pertanyaan_html')->nullable()->after('gambar_soal');
            $table->string('gambar_opsi_a')->nullable()->after('opsi_a');
            $table->string('gambar_opsi_b')->nullable()->after('opsi_b');
            $table->string('gambar_opsi_c')->nullable()->after('opsi_c');
            $table->string('gambar_opsi_d')->nullable()->after('opsi_d');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('soal_quiz', function (Blueprint $table) {
            $table->dropColumn([
                'gambar_soal',
                'pertanyaan_html',
                'gambar_opsi_a',
                'gambar_opsi_b',
                'gambar_opsi_c',
                'gambar_opsi_d'
            ]);
        });
    }
};
