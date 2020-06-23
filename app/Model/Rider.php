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
        'token',
        'channel',
        'is_available'
    ];

    protected $append = ['rate'];

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

    public function toJsonArray() {
        return [
            'id' => $this->id,
            'full_name' => $this->full_name,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'image' => $this->image,
            'country' => $this->country,
            'city' => $this->city,
            'ride_number' => $this->ride_number,
            'token' => $this->token,
            'channel' => $this->channel,
            'vehicle' => $this->vehicle->toJsonArray(),
            'rate' => $this->rate,
            'is_available' => $this->is_available,
            'is_authenticated' => $this->is_authenticated,
        ];
    }
}
