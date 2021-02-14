<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KontrakMesin extends Model
{
    protected $table = 'kontrak_mesin';
    protected $guarded = [];

    public function vendor()
    {
        return $this->belongsTo('App\Vendor');
    }

   
}
