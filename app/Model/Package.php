<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $fillable = ['name', 'weight', 'description'];

    public function recipients() {
        return $this->hasMany('App\Model\Recipient');
    }

    public function toJsonArray() {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'weight' => $this->weight,
            'description' => $this->description,
            'recipients' => $this->recipients->toArray()
        ];
    }
}
