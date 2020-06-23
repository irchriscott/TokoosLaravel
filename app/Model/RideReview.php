<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class RideReview extends Model
{
    protected $fillable = ['ride_id', 'amount_paid', 'rate', 'comments'];

    public function toJsonArray() {
        return [
            'id' => $this->id,
            'amount_paid' => $this->amount_paid,
            'rate' => $this->rate,
            'comment' => $this->comments
        ];
    }
}
