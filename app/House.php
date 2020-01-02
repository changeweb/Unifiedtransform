<?php

namespace App;

use App\Model;
// use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    /**
     * Gets the associated users for each hosue
     * 
     */
    public function students()
    {
        return $this->hasMany('App\StudentInfo', 'house_id');
    }
}
