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
        Schema::table('jawaban_quiz', function (Blueprint $table) {
            $table->string('kunci_jawaban')->nullable()->after('jawaban_siswa');
            $table->boolean('benar')->default(false)->after('kunci_jawaban');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jawaban_quiz', function (Blueprint $table) {
            $table->dropColumn(['kunci_jawaban', 'benar']);
        });
    }
};
