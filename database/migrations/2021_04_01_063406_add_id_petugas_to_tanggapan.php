<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdPetugasToTanggapan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tanggapan', function (Blueprint $table) {
            $table->unsignedBigInteger('id_petugas')->nullable();
            $table->foreign('id_petugas')->references('id')->on('petugas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tanggapan', function (Blueprint $table) {
            $table->dropColumn('id_petugas');
        });
    }
}