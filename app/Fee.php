<?php

namespace App;

use App\Model;

class Fee extends Model
{
    protected $fillable = ['school_id', 'fee_channel_id', 'fee_type_id', 'session'];
    
    public function fee_type(){
        return $this->belongsTo('App\FeeType', 'fee_type_id');
    }

    public function fee_channel(){
        return $this->belongsTo('App\FeeChannel', 'fee_channel_id');
    }

}
