<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class RideCancelation extends Model
{
    protected $fillable = ['ride_id', 'reason'];

    public function ride() {
        return $this->belongsTo(App\Model\Ride::class);
    }
}
