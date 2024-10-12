<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTNilaiSiswaTable extends Migration
{
    public function up()
    {
        Schema::create('t_nilai_siswa', function (Blueprint $table) {
            $table->increments('nilai_siswa_id');
            $table->unsignedInteger('siswa_id');
            $table->unsignedInteger('sub_kriteria_id');
            $table->integer('nilai_siswa_count');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->unsignedInteger('created_by')->nullable();

            $table->foreign('siswa_id')->references('siswa_id')->on('d_siswa')->onDelete('cascade');
            $table->foreign('sub_kriteria_id')->references('sub_kriteria_id')->on('m_sub_kriteria')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('t_nilai_siswa');
    }
}
