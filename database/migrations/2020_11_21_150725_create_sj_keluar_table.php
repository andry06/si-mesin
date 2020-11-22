<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSjKeluarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sj_keluar', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('document_number', 45);
            $table->date('tgl_keluar');
            $table->unsignedBigInteger('vendor_id');
            $table->string('status_keluar', 45);
            $table->unsignedBigInteger('kontrak_id')->nullable();
            $table->integer('no_bc')->nullable();
            $table->timestamps();
            $table->foreign('vendor_id')->references('id')->on('vendor')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('kontrak_id')->references('id')->on('kontrak_mesin')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sj_keluar');
    }
}
