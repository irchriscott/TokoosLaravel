<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class RideReview extends Model
{
    protected $fillable = ['ride_id', 'amount_paid', 'rate', 'comments'];
}
