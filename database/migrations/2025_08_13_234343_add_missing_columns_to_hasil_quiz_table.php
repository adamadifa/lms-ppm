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
        Schema::table('hasil_quiz', function (Blueprint $table) {
            $table->integer('jumlah_benar')->default(0)->after('nilai');
            $table->integer('jumlah_salah')->default(0)->after('jumlah_benar');
            $table->integer('total_soal')->default(0)->after('jumlah_salah');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hasil_quiz', function (Blueprint $table) {
            $table->dropColumn(['jumlah_benar', 'jumlah_salah', 'total_soal']);
        });
    }
};
