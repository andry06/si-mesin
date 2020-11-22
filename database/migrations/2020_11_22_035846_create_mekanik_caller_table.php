<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMekanikCallerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mekanik_caller', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('notrx_caller');
            $table->unsignedBigInteger('mesin_id');
            $table->unsignedBigInteger('user_supervisor_id');
            $table->string('keluhan_mesin', 45);
            $table->timestamps();
            $table->foreign('mesin_id')->references('id')->on('master_mesin')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('user_supervisor_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mekanik_caller');
    }
}
