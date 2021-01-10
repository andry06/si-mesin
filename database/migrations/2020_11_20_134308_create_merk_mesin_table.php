<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMerkMesinTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merk_mesin', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('merk_mesin', 50)->unique();
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
        Schema::dropIfExists('merk_mesin');
    }
}
