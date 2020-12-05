<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class perusahaan extends Model
{
    //CRUD DENGAN ORM
    protected $table = 'Perusahaan';
    // mendefinisikan yg pingin diisi
    // protected $fillable = ["nama_perusahaan", "alamat", "no_telp", "email"]; 
    
    //mendefinisikan yg gak pengin di isi
    protected $guarded = [];

    public function author(){
        return $this->belongsTo('App\User', 'createduser_id');
    }
}
