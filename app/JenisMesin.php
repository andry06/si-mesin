<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JenisMesin extends Model
{
    protected $table = 'jenis_mesin';
    // mendefinisikan yg pingin diisi
    // protected $fillable = ["nama_perusahaan", "alamat", "no_telp", "email"]; 
    
    //mendefinisikan yg gak pengin di isi
    protected $guarded = [];
}
