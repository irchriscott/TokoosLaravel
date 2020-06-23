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
        'delivery_fare',
        'weight',
        'size',
        'value'
    ];

    public function toJsonArray() {
        return [
            'base_fare' => $this->base_fare, 
            'distance' => $this->distance, 
            'time' => $this->time, 
            'wait_per_minute' => $this->wait_per_minute,
            'delivery_fare' => $this->delivery_fare,
            'weight' => $this->weight,
            'size' => $this->size,
            'value' => $this->value
        ];
    }
}
