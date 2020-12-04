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

    protected $hidden = ['created_at', 'updated_at', 'ride_type_id'];
}
