<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class RideType extends Model
{
    protected $fillable = ['name', 'size'];

    protected $with = ['fare'];

    protected $hidden = ['created_at', 'updated_at'];

    protected $appends = ['icon'];

    public function fare()
    {
        return $this->hasOne('App\Model\RideFare');
    }

    public function getIconAttribute() 
    {
        $rides = ['boda.png', 'x.png', 'xl.png'];
        return '/uploads/rides/' . $rides[$this->id - 1];
    }
}
