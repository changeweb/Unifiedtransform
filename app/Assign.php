<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assign extends Model
{
    public function fees()
    {
        return $this->belongsTo('App\Fee', 'fee_id');
    }
}
