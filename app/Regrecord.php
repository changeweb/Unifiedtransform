<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Regrecord extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function section()
    {
        return $this->belongsTo('App\Section');
    }

    public function house()
    {
        return $this->belongsTo('App\House');
    }

    // public function fee()
    // {
    //     return $this->belongsTo('App\Fee');
    // }

}
