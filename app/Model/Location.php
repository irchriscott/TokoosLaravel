<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = ['address', 'longitude', 'latitude'];

    public function toJsonArray() {
        return [
            'id' => $this->id,
            'address' => $this->address,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude
        ];
    }
}
