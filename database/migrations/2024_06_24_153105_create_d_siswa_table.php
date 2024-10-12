<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDSiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('d_siswa', function (Blueprint $table) {
            $table->increments('siswa_id');
            $table->integer('siswa_no_pendaftaran')->unique(); 
            $table->string('siswa_nama');
            $table->string('siswa_tempat_lahir');
            $table->date('siswa_tanggal_lahir');
            $table->string('siswa_asal_sekolah');
            $table->boolean('siswa_jenis_kelamin');
            $table->dateTime('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->integer('created_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('d_siswa');
    }
}
