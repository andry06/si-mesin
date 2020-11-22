<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMekanikServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mekanik_service', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('mekanikcaller_id');
            $table->string('notrx_servise', 45);
            $table->unsignedBigInteger('user_mekanik_id');
            $table->string('masalah_mesin', 45);
            $table->dateTime('time_service');
            $table->timestamps();
            $table->foreign('mekanikcaller_id')->references('id')->on('mekanik_caller')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('user_mekanik_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mekanik_service');
    }
}
