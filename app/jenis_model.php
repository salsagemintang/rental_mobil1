<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class jenis_model extends Model
{
     protected $table="jenis_mobil";
    protected $primaryKey="id";
    public $timestamps= false;
    protected $fillable = [
    'nama_jenis'
  ];
}
