<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMJurusanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_jurusan', function (Blueprint $table) {
            $table->id('jurusan_id');
            $table->string('jurusan_kode');
            $table->string('jurusan_nama');
            $table->datetime('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->integer('create_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('m_jurusan');
    }
}

