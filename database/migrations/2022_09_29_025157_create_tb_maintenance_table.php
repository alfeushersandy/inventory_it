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
        Schema::create('tb_maintenance', function (Blueprint $table) {
            $table->id('id_maintenance');
            $table->unsignedBigInteger('serah_id')->nullable();
            $table->unsignedBigInteger('lokasi_id')->nullable();
            $table->unsignedBigInteger('barang_id');
            $table->string('pic');
            $table->date('tanggal_service');
            $table->timestamp('tanggal_selesai_service')->nullable();
            $table->string('ket')->nullable();
            $table->integer('biaya');
            $table->string('status');
            $table->timestamps();

            $table->foreign('lokasi_id')->references('id_lokasi')->on('lokasi');
            $table->foreign('serah_id')->references('id_serah')->on('serah_terima');
            $table->foreign('barang_id')->references('id_barang')->on('master_barang');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_maintenance');
    }
};
