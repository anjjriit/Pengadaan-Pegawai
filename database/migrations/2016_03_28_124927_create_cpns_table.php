<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCpnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cpns', function (Blueprint $table) {
            $table->bigInteger('nik')->unique()->unsigned();
            $table->string('nama',50);
            $table->string('alamat',50);
            $table->string('no_telp',50);
            $table->string('email',50);
            $table->string('foto',255);
            $table->double('ipk',4,3);
            $table->double('hasil_tes',6,4);
            $table->integer('jurusan')->unsigned();
            $table->integer('pendidikan_akhir')->unsigned();
            $table->foreign('jurusan')->references('id')->on('jurusan');
            $table->foreign('pendidikan_akhir')->references('id')->on('pendidikan');
        });
    }

    /**
     * Reverse the migrations.
     *  
     * @return void
     */
    public function down()
    {       
        Schema::table('cpns', function (Blueprint $table) {
            Schema::drop('cpns');
        });
    }
}
