<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    protected $fillable = ['user_id', 'address', 'longitude', 'latitude', 'type'];

    protected $hidden = ['created_at', 'updated_at'];
}
