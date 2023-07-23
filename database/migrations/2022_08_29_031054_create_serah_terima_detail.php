<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('serah_terima_detail', function (Blueprint $table) {
            $table->id('id_serah_detail');
            $table->unsignedBigInteger('serah_id');
            $table->unsignedBigInteger('barang_id');
            $table->unsignedBigInteger('lokasi_awal_id');
            $table->unsignedBigInteger('lokasi_tujuan_id');
            $table->date('tanggal_serah');
            $table->date('tanggal_kembali');
            $table->boolean('status');
            $table->timestamps();

            $table->foreign('serah_id')->references('id_serah')->on('serah_terima');
            $table->foreign('barang_id')->references('id_barang')->on('master_barang');
            $table->foreign('lokasi_awal_id')->references('id_lokasi')->on('lokasi');
            $table->foreign('lokasi_tujuan_id')->references('id_lokasi')->on('lokasi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('serah_terima_detail');
    }
};
