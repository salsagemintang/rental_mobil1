<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class penyewa_model extends Model
{
    protected $table="penyewa";
    protected $primaryKey="id";
    public $timestamps= false;
    protected $fillable = [
    'nama_penyewa', 'alamat', 'telp', 'no_ktp', 'foto'
  ];
}
