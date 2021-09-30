<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLokasiBarangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lokasi_barang', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_barang')->unsigned()->default(null);
            $table->foreign('id_barang')->references('id')->on('barang');
            $table->bigInteger('id_lokasi')->unsigned()->default(null);
            $table->foreign('id_lokasi')->references('id')->on('lokasi');
            $table->bigInteger('jumlah');
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
        Schema::dropIfExists('lokasi_barang');
    }
}
