<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = "books";
    
    public function school(){
        return $this->belongsTo('App\School');
    }
    /**
     * Get the class record associated with the user.
    */
    public function class()
    {
        return $this->belongsTo('App\Myclass');
    }
    /**
     * Get the student record associated with the user.
    */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
