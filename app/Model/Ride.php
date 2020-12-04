<?php

namespace App\Model;

use App\Model\Location;
use Illuminate\Database\Eloquent\Model;

class Ride extends Model
{
    protected $fillable = [
        'rider_id',
        'user_id',
        'type',
        'code',
        'origine',
        'destination',
        'package_id',
        'status',
        'price_range',
        'currency',
        'bonus',
        'tips',
        'number_of_people',
        'amount_paid',
        'distance',
        'duration',
        'time_departure',
        'time_arrive'
    ];

    protected $with = ['user', 'rider', 'package'];

    protected $appends = ['from', 'to'];

    public function rider() {
        return $this->belongsTo('App\Model\Rider');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function package() {
        return $this->hasOne('App\Model\Package');
    }

    public function getFromAttribute() {
        return Location::find($this->origin);
    }

    public function getToAttribute() {
        return Location::find($this->destination);
    }

    public function review() {
        return $this->hasOne('App\Model\RideReview');
    }
}
