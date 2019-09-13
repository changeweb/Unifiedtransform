<?php

namespace App;

use App\Model;

class Department extends Model
{
    protected $guarded = [];

    public function teachers()
    {
        return $this->hasMany('App\User', 'department_id');
    }

    public function school()
    {
        return $this->belongsTo('App\School', 'school_id');
    }
}
