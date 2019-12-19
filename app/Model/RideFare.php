<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class RideFare extends Model
{
    protected $fillable = [
        'ride_type_id', 
        'base_fare', 
        'distance', 
        'time', 
        'wait_per_minute', 
        'deliveryFare',
        'weight',
        'size',
        'value'
    ];

    public function toJsonArray() {
        return [
            'baseFare' => $this->base_fare, 
            'distance' => $this->distance, 
            'time' => $this->time, 
            'waitPerMinute' => $this->wait_per_minute,
            'deliveryFare' => $this->delivery_fare,
            'weight' => $this->weight,
            'size' => $this->size,
            'value' => $this->value
        ];
    }
}
