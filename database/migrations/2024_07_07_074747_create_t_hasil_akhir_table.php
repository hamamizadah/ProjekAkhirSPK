<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTHasilAkhirTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_hasil_akhir', function (Blueprint $table) {
            $table->bigIncrements('hasil_akhir_id');
            $table->unsignedInteger('siswa_id');
            $table->unsignedBigInteger('jurusan_id');
            $table->float('hasil_akhir_nilai');
            $table->timestamps();
            $table->unsignedBigInteger('created_by')->nullable();

            $table->foreign('siswa_id')->references('siswa_id')->on('d_siswa')->onDelete('cascade');
            $table->foreign('jurusan_id')->references('jurusan_id')->on('m_jurusan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_hasil_akhir');
    }
}
