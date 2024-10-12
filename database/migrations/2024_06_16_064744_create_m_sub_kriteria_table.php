<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMSubKriteriaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_sub_kriteria', function (Blueprint $table) {
            $table->increments('sub_kriteria_id');
            $table->unsignedInteger('kriteria_id');
            $table->string('sub_kriteria_nama');
            $table->datetime('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->integer('created_by')->nullable();;

            // Define foreign key
            $table->foreign('kriteria_id')->references('kriteria_id')->on('m_kriteria')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('m_sub_kriteria');
    }
}
