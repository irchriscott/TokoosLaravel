<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ReportRide extends Model
{
    protected $fillable = ['user_id', 'ride_id', 'reason'];
}
