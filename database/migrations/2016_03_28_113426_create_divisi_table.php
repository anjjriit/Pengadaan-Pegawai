<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDivisiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('divisi', function (Blueprint $table) {
            $table->text('syarat_hasil_tes');
            $table->string('nama_departemen',30);
            $table->string('nama_divisi',30);
            $table->integer('kuota');
            $table->double('ipk',4,3);
            $table->integer('syarat_pendidikan')->unsigned();
            $table->integer('syarat_jurusan')->unsigned();
            $table->integer('kebutuhan_id')->unsigned();
            $table->timestamps();
            $table->foreign('syarat_pendidikan')->references('id')->on('pendidikan');
            $table->foreign('syarat_jurusan')->references('id')->on('jurusan');
            $table->foreign('kebutuhan_id')->references('id')->on('kebutuhan');
            $table->primary(array('nama_divisi', 'kebutuhan_id'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::table('divisi', function (Blueprint $table) {
            Schema::drop('divisi');
        });
    }
}
