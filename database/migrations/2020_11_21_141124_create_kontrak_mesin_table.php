<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKontrakMesinTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kontrak_mesin', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('no_kontrak', 50)->nullable();
            $table->unsignedBigInteger('vendor_id');
            $table->date('tgl_awal_kontrak')->nullable();
            $table->date('tgl_jatuh_tempo')->nullable();
            $table->string('keterangan', 50)->nullable();
            $table->string('status',50)->nullable();
            $table->foreign('vendor_id')->references('id')->on('vendor')->onDelete('restrict')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kontrak_mesin');
    }
}
