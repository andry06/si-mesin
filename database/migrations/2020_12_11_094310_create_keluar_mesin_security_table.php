<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeluarMesinSecurityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keluar_mesin_security', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('sjkeluar_id');
            $table->unsignedBigInteger('mesin_id');
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
        Schema::dropIfExists('keluar_mesin_security');
    }
}
