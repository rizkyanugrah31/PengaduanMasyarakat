<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTanggapan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tanggapan', function (Blueprint $table) {
            $table->id();
            $table->longText('isi_tanggapan');
            $table->unsignedBigInteger('id_pengaduan')->nullable();
            $table->foreign('id_pengaduan')->references('id')->on('pengaduan');
            $table->unsignedBigInteger('id_petugas')->nullable();
            $table->foreign('id_petugas')->references('id')->on('users');
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
        Schema::dropIfExists('tanggapan');
    }
}
