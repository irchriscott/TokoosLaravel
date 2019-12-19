<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    protected $fillable = ['user_id', 'address', 'longitude', 'latitude', 'type'];

    public function toJsonArray() {
        return [
            'id' => $this->id,
            'address' => $this->address,
            'longitude' => $this->longitude,
            'latitude' => $this->latitude,
            'type' => $this->type
        ];
    }
}
