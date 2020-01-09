<?php

namespace App;

use App\Model;

class Payment extends Model
{
    public function fees()
    {
        return $this->belongsTo('App\Fee', 'fee_id');
    }
}
