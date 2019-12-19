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

    public function rider() {
        return $this->belongsTo('App\Model\Rider', 'rider_id', 'id');
    }

    public function type() {
        return $this->belongsTo('App\Model\RideType', 'ride_type_id', 'id');
    }

    public function toJsonArray() {
        return [
            'id' => $this->id,
            'type' => $this->type->toJsonArray(),
            'brand' => $this->brand,
            'name' => $this->name,
            'plateNumber' => $this->number_plate,
            'productionYear' => $this->production_year,
            'mileage' => $this->mileage,
            'power' => $this->power,
            'maxPeople' => $this->max_people
        ];
    }
}
