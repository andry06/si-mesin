<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeluarMesinTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keluar_mesin', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('sjkeluar_id');
            $table->unsignedBigInteger('mesin_id');
            $table->integer('harga')->nullable();
            $table->timestamps();
            $table->foreign('sjkeluar_id')->references('id')->on('sj_keluar')->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('keluar_mesin');
    }
}
