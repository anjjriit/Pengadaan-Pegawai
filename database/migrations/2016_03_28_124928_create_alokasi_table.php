<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlokasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alokasi', function (Blueprint $table) {
            $table->string('cpns_nik');
            $table->string('divisi',30);
            $table->integer('kebutuhan')->unsigned();
            $table->timestamps();
            $table->foreign('cpns_nik')->references('nik')->on('cpns');
            $table->foreign('divisi')->references('nama_divisi')->on('divisi');
            $table->foreign('kebutuhan')->references('id')->on('kebutuhan');
            $table->primary(array('cpns_nik','divisi','kebutuhan'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('alokasi', function (Blueprint $table) {
            Schema::drop('alokasi');
        });
    }
}