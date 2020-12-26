<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJenisMesinTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jenis_mesin', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('jenis_mesin', 50);
            $table->string('singkatan', 10);
            $table->unsignedBigInteger('createduser_id');
            $table->timestamps();
            $table->foreign('createduser_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jenis_mesin');
    }
}
