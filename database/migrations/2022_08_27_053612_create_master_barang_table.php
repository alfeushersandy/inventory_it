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
        Schema::create('master_barang', function (Blueprint $table) {
            $table->id('id_barang');
            $table->string('kode_barang');
            $table->string('kode_barang_lama')->nullable();
            $table->unsignedBigInteger('kategori_id');
            $table->string('merek')->nullable();
            $table->string('tipe')->nullable();
            $table->unsignedBigInteger('lokasi_id');
            $table->string('user')->nullable();
            $table->string('mainboard')->nullable();
            $table->string('prosesor')->nullable();
            $table->string('memori')->nullable();
            $table->string('vga')->nullable();
            $table->string('sound')->nullable();
            $table->string('network')->nullable();
            $table->boolean('keyboard')->nullable();
            $table->boolean('mouse')->nullable();
            $table->string('os')->nullable();
            $table->string('status')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('kategori_id')->references('id_kategori')->on('kategori');
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
        Schema::dropIfExists('master_barang');
    }
};
