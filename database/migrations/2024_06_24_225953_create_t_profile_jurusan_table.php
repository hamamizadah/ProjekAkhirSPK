<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTProfileJurusanTable extends Migration
{
    public function up()
    {
        Schema::create('t_profile_jurusan', function (Blueprint $table) {
            $table->increments('profile_id');
            $table->unsignedBigInteger('jurusan_id');
            $table->unsignedInteger('sub_kriteria_id');
            $table->integer('profile_nilai_target');
            $table->double('profile_core');
            $table->timestamps(); // Includes created_at and updated_at
            $table->integer('created_by')->nullable();

            // Foreign key constraints
            $table->foreign('jurusan_id')->references('jurusan_id')->on('m_jurusan')->onDelete('cascade');
            $table->foreign('sub_kriteria_id')->references('sub_kriteria_id')->on('m_sub_kriteria')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('t_profile_jurusan');
    }
}
