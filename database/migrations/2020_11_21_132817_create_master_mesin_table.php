<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterMesinTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_mesin', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('barcode_mesin', 15)->nullable();
            $table->unsignedBigInteger('jenismesin_id');
            $table->unsignedBigInteger('merkmesin_id');
            $table->string('type', 45);
            $table->string('no_seri', 45)->nullable();
            $table->string('photo', 255)->nullable();
            $table->integer('qty');
            $table->unsignedBigInteger('createduser_id');
            $table->timestamps();
            $table->foreign('createduser_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('jenismesin_id')->references('id')->on('jenis_mesin')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('merkmesin_id')->references('id')->on('merk_mesin')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_mesin');
    }
}
