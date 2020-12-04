<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $fillable = ['name', 'weight', 'description'];

    protected $with = ['recipients'];

    public function recipients() {
        return $this->hasMany('App\Model\Recipient');
    }
}
