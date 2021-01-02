<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MasterMesin extends Model
{
    protected $table = 'master_mesin';
    protected $guarded = [];

    public function jenismesin()
    {
        return $this->belongsTo('App\JenisMesin');
    }

    public function merkmesin()
    {
        return $this->belongsTo('App\MerkMesin');
    }

    public function vendor()
    {
        return $this->belongsTo('App\Vendor');
    }
}
