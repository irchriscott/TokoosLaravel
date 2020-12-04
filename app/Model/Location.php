<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = ['address', 'longitude', 'latitude'];

    protected $hidden = ['created_at', 'updated_at'];
}
