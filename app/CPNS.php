<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CPNS extends Model
{
    protected $table = 'cpns';
    public $incrementing = false; 
	protected $primaryKey = 'nik';
    public function jurusan(){
    	return $this->hasOne('App\Jurusan', 'id', 'jurusan');
    }

    public function pendidikan(){
    	return $this->hasOne('App\Pendidikan', 'id', 'pendidikan_akhir');
    }
}