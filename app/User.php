<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 
        'email', 
        'password', 
        'country_code',
        'phone_number', 
        'country', 
        'city', 
        'token', 
        'channel', 
        'is_authenticated'
    ];

    public function toJsonArray() {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'country_code' => $this->country_code,
            'phone_number' => $this->phone_number,
            'country' => $this->country,
            'city' => $this->city,
            'image' => $this->image,
            'token' => $this->token,
            'channel' => $this->channel,
            'is_authenticated' => $this->is_authenticated
        ];
    }

    protected $hidden = [
        'password', 'remember_token',
    ];
}
