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

    public function rider() {
        return $this->belongsTo('App\Model\Rider');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function package() {
        return $this->hasOne('App\Model\Package');
    }

    public function from() {
        return Location::find($this->origin);
    }

    public function to() {
        return Location::find($this->destination);
    }

    public function review() {
        return $this->hasOne('App\Model\RideReview');
    }

    public function type() {

    }

    public function toJsonArray() {
        return [
            'id' => $this->id,
            'rider' => $this->rider->toJsonArray(),
            'user' => $this->user->toJsonArray(),
            'type' => $this->type,
            'origin' => $this->from(),
            'destination' => $this->to(),
            'packageRide' => $this->package_id != NULL ? $this->package->toJsonArray() : NULL,
            'status' => $this->status,
            'priceRange' => $this->price_range,
            'currency' => $this->currency,
            'numberOfPeople' => $this->number_of_people,
            'amountPaid' => $this->amount_paid,
            'distance' => $this->distance,
            'duration' => $this->duration,
            'timeDeparture' => $this->time_departure,
            'timeArrive' => $this->time_arrive,
            'review' => $this->review,
            'createdAt' => $this->created_at->toDateTimeString(),
            'updatedAt' => $this->updated_at->toDateTimeString()
        ];
    }
}
