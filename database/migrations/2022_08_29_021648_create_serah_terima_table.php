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
        Schema::create('serah_terima', function (Blueprint $table) {
            $table->id('id_serah');
            $table->date('tanggal_input');
            $table->string('kode_serah');
            $table->string('user');
            $table->unsignedBigInteger('lokasi_id');
            $table->integer('jumlah_barang');
            $table->date('tanggal_serah');
            $table->date('tanggal_kembali');
            $table->string('status');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('lokasi_id')->references('id_lokasi')->on('lokasi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('serah_terima');
    }
};
