<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterLayoutTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_layout', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('identitas', 45);
            $table->unsignedBigInteger('location_id');
            $table->date('start');
            $table->date('finish')->nullable();
            $table->unsignedBigInteger('user_supervisor_id');
            $table->timestamps();
            $table->foreign('location_id')->references('id')->on('location')->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('master_layout');
    }
}
