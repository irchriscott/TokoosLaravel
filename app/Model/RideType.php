<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class RideType extends Model
{
    protected $fillable = ['name', 'size'];

    protected $with = ['fare'];

    protected $hidden = ['created_at', 'updated_at'];

    public function vehicles()
    {
        return $this->hasMany('App\Model\Vehicle');
    }

    public function fare(){
        return $this->hasOne('App\Model\RideFare');
    }
}
