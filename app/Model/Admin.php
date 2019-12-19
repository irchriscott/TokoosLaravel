<?php

namespace App\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use Notifiable;
    
    protected $fillable = [
      'full_name', 'email', 'phone_number', 'country', 'city', 'password'
    ];

    protected $hidden = [
      'password'
    ];
}
