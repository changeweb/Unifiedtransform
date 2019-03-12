<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExamForClass extends Model
{
    public $timestamps = false;

    public function classes(){
        return $this->hasMany('App\Myclass');
    }
}
