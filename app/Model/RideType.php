<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class RideType extends Model
{
    protected $fillable = ['name', 'size'];

    public function vehicles()
    {
        return $this->hasMany('App\Model\Vehicle');
    }

    public function fare(){
        return $this->hasOne('App\Model\RideFare');
    }

    static function allToJson() {
        $all = [];
        foreach(self::all() as $rideType) { $all[] = $rideType->toJsonArray(); }
        return $all;
    }

    public function toJsonArray() {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'size' => $this->size,
            'fare' => $this->fare->toJsonArray()
        ];
    }
}
