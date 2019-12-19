<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Recipient extends Model
{
    protected $fillable = ['name', 'phone'];

    public function toJsonArray() {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'phone' => $this->phone
        ];
    }
}
