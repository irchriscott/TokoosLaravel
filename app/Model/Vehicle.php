<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = [
        'ride_type_id',
        'rider_id',
        'brand',
        'name',
        'number_plate',
        'production_year',
        'mileage',
        'power',
        'max_people'
    ];

    protected $with = ['rider', 'type'];

    public function rider() {
        return $this->belongsTo('App\Model\Rider', 'rider_id', 'id');
    }

    public function type() {
        return $this->belongsTo('App\Model\RideType', 'ride_type_id', 'id');
    }
}
