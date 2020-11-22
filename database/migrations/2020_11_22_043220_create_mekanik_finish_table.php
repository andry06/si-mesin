<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMekanikFinishTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mekanik_finish', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('mekanikservice_id');
            $table->string('notrx_finish', 45);
            $table->unsignedBigInteger('user_supervisor_id');
            $table->dateTime('time_finish');
            $table->timestamps();
            $table->foreign('mekanikservice_id')->references('id')->on('mekanik_service')->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('mekanik_finish');
    }
}
