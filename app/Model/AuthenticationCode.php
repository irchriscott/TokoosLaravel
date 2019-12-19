<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AuthenticationCode extends Model
{
    protected $fillable = ['user_id', 'code', 'expary_date', 'is_authenticated'];
}
