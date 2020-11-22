<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLayoutMesinTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('layout_mesin', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('layout_id');
            $table->unsignedBigInteger('mesin_id');
            $table->integer('posisi_baris');
            $table->integer('posisi_kolom');
            $table->string('status', 20);
            $table->timestamps();
            $table->foreign('layout_id')->references('id')->on('master_layout')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('mesin_id')->references('id')->on('master_mesin')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('layout_mesin');
    }
}
