<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMKriteriaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_kriteria', function (Blueprint $table) {
            $table->increments('kriteria_id'); // int
            $table->string('kriteria_nama');   // string           
            $table->datetime('created_at')->nullable(); // datetime, nullable
            $table->timestamp('updated_at')->nullable(); // timestamp, nullable
            $table->unsignedInteger('create_by')->nullable(); // int, nullable

            
            $table->foreign('create_by')->references('id')->on('users')->onDelete('set null');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('m_kriteria');
    }
}
