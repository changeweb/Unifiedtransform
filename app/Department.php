<?php

namespace App;

use App\Model;

class Department extends Model
{
    public function teachers(){
        return $this->hasMany('App\User','department_id');
    }
}
