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
        Schema::create('materi_video', function (Blueprint $table) {
            $table->id();
            $table->foreignId('materi_id')->constrained('materi')->onDelete('cascade');
            $table->string('judul');
            $table->text('deskripsi')->nullable();
            $table->string('youtube_url');
            $table->string('youtube_id')->nullable(); // YouTube video ID untuk embed
            $table->integer('urutan')->default(1); // Urutan video dalam materi
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
            $table->timestamps();

            // Index untuk performa
            $table->index(['materi_id', 'urutan']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('materi_video');
    }
};
