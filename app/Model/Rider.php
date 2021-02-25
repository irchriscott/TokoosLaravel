<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Rider extends Model
{
    protected $fillable = [
        'full_name',
        'email',
        'phone_number',
        'image',
        'address',
        'country',
        'city',
        'ride_number',
        'auth_code',
        'token',
        'channel',
        'is_available'
    ];

    protected $appends = ['rate'];

    protected $with = ['vehicle'];

    protected $hidden = ['auth_code', 'rides'];

    public function vehicle() {
        return $this->hasOne('App\Model\Vehicle');
    }

    public function rides() {
        return $this->hasMany('App\Model\Ride');
    }

    public function getRateAttribute() {
        $total = 0;
        $count = 0;
        foreach($this->rides as $ride) {
            if($ride->review != NULL) {
                $total += $ride->review->rate;
                $count++; 
            }
        }

        return $total != 0 && $count != 0 ? $total / $count : 0;
    }
}
